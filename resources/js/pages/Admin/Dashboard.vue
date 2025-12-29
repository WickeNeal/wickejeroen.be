<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    projects: Array<{
        id: number;
        title: string;
        cover_image_path: string | null;
        images_count: number;
    }>;
}>();
</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="min-h-screen bg-gray-900 font-sans text-white">
        <!-- Header -->
        <header class="border-b border-gray-800 bg-gray-900 px-6 py-4 shadow">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold uppercase tracking-widest text-[#B5A58D]">Dashboard</h1>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-400">Welcome, Admin</span>
                    <Link
                        href="/admin/logout"
                        method="post"
                        as="button"
                        class="text-sm text-red-400 hover:text-red-300 hover:underline"
                    >
                        Logout
                    </Link>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="container mx-auto p-6">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-2xl font-bold">Projects</h2>
                <Link
                    href="/admin/projects/create"
                    class="rounded bg-[#B5A58D] px-4 py-2 font-bold text-gray-900 hover:bg-[#a3947e]"
                >
                    + New Project
                </Link>
            </div>

            <div v-if="projects.length === 0" class="rounded-lg border border-dashed border-gray-700 p-12 text-center text-gray-500">
                <p>No projects yet. Create one to get started.</p>
            </div>

            <div v-else class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="project in projects"
                    :key="project.id"
                    class="overflow-hidden rounded-lg bg-gray-800 shadow transition hover:shadow-lg"
                >
                    <div class="relative aspect-video bg-gray-700">
                        <img
                            v-if="project.cover_image_path"
                            :src="'/storage/' + project.cover_image_path"
                            class="h-full w-full object-cover"
                            alt="Cover"
                        />
                        <div v-else class="flex h-full items-center justify-center text-gray-500">No Image</div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-white">{{ project.title }}</h3>
                        <p class="text-sm text-gray-400">{{ project.images_count }} images</p>
                        <div class="mt-4 flex gap-2">
                            <Link
                                :href="`/admin/projects/${project.id}/edit`"
                                class="flex-1 rounded border border-gray-600 py-1 text-center text-sm font-medium hover:bg-gray-700"
                            >
                                Edit
                            </Link>
                            <!-- Delete button (form) could go here -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
