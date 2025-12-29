<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'projects' => Project::withCount('images')->latest()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/ProjectForm');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB max
        ]);

        $project = Project::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(4), // Ensure uniqueness
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store("projects/{$project->id}", 'public');

                $projectImage = $project->images()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);

                // Set first image as cover if not set
                if (!$project->cover_image_path) {
                    $project->update(['cover_image_path' => $path]);
                }
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return Inertia::render('Admin/ProjectForm', [
            'project' => $project->load('images'),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('images')) {
            // Get current max sort order
            $currentMaxOrder = $project->images()->max('sort_order') ?? -1;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store("projects/{$project->id}", 'public');

                $project->images()->create([
                    'image_path' => $path,
                    'sort_order' => $currentMaxOrder + 1 + $index,
                ]);

                // Set cover if missing (e.g. if all previous were deleted)
                if (!$project->cover_image_path) {
                    $project->update(['cover_image_path' => $path]);
                }
            }
        }

        return redirect()->back()->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        // Delete files
        Storage::disk('public')->deleteDirectory("projects/{$project->id}");

        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Project deleted.');
    }

    public function destroyImage(Project $project, ProjectImage $image)
    {
        if ($image->project_id !== $project->id) {
            abort(403);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        // If we deleted the cover image, pick a new one
        if ($project->cover_image_path === $image->image_path) {
            $nextImage = $project->images()->orderBy('sort_order')->first();
            $project->update([
                'cover_image_path' => $nextImage ? $nextImage->image_path : null,
            ]);
        }

        return redirect()->back()->with('success', 'Image deleted.');
    }
}
