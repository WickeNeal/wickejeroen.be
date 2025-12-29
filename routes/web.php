<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // Get random projects for the masonry wall
    $projects = App\Models\Project::whereNotNull('cover_image_path')->inRandomOrder()->take(15)->get();
    return Inertia::render('Welcome', [
        'projects' => $projects
    ]);
});

Route::get('/realisaties/{slug}', function ($slug) {
    $project = App\Models\Project::where('slug', $slug)->with('images')->firstOrFail();
    return Inertia::render('ProjectDetail', ['project' => $project]);
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'create'])->name('login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'store']);
Route::post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin.dashboard');

    // Project Routes
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class)->except(['show']);
    Route::delete('/projects/{project}/images/{image}', [App\Http\Controllers\Admin\ProjectController::class, 'destroyImage'])->name('projects.images.destroy');
});