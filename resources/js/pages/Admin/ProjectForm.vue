<script setup lang="ts">
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    project?: {
        id: number;
        title: string;
        description: string | null;
        images: Array<{
            id: number;
            image_path: string;
        }>;
    };
}>();

const isEditing = !!props.project;

const form = useForm({
    title: props.project?.title || '',
    description: props.project?.description || '',
    images: [] as File[],
});

const previewImages = ref<string[]>([]);

const handleFileChange = (event: Event) => {
    const files = (event.target as HTMLInputElement).files;
    if (files) {
        form.images = Array.from(files);
        
        // Create previews
        previewImages.value = [];
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (e.target?.result) {
                    previewImages.value.push(e.target.result as string);
                }
            };
            reader.readAsDataURL(files[i]);
        }
    }
};

const submit = () => {
    if (isEditing) {
        form.transform((data) => ({
            ...data,
            _method: 'put',
        })).post(`/admin/projects/${props.project!.id}`, {
            forceFormData: true,
        });
    } else {
        form.post('/admin/projects', {
            forceFormData: true,
        });
    }
};

const deleteImage = (imageId: number) => {
    if (confirm('Are you sure you want to delete this image?')) {
        router.delete(`/admin/projects/${props.project!.id}/images/${imageId}`);
    }
};
</script>

<template>
    <Head :title="isEditing ? 'Edit Project' : 'New Project'" />

    <div class="min-h-screen bg-gray-900 font-sans text-white">
        <header class="border-b border-gray-800 bg-gray-900 px-6 py-4 shadow">
            <div class="container mx-auto flex items-center justify-between">
                <Link href="/admin/dashboard" class="text-sm text-gray-400 hover:text-white">
                    &larr; Back to Dashboard
                </Link>
                <h1 class="text-xl font-bold uppercase tracking-widest text-[#B5A58D]">
                    {{ isEditing ? 'Edit Project' : 'New Project' }}
                </h1>
                <div class="w-20"></div> <!-- Spacer -->
            </div>
        </header>

        <main class="container mx-auto max-w-2xl p-6">
            <form @submit.prevent="submit" class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-400">Folder Name (Title)</label>
                    <input
                        v-model="form.title"
                        type="text"
                        required
                        class="mt-1 block w-full rounded border-gray-700 bg-gray-800 px-3 py-2 text-white focus:border-[#B5A58D] focus:ring-[#B5A58D]"
                        placeholder="e.g. Shoot Summer 2024"
                    />
                    <div v-if="form.errors.title" class="mt-1 text-sm text-red-500">{{ form.errors.title }}</div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-400">Description (Optional)</label>
                    <textarea
                        v-model="form.description"
                        rows="3"
                        class="mt-1 block w-full rounded border-gray-700 bg-gray-800 px-3 py-2 text-white focus:border-[#B5A58D] focus:ring-[#B5A58D]"
                    ></textarea>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-400">Upload Images</label>
                    <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-700 px-6 pb-6 pt-5 hover:border-[#B5A58D] transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-400 justify-center">
                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-gray-800 font-medium text-[#B5A58D] focus-within:outline-none focus-within:ring-2 focus-within:ring-[#B5A58D] focus-within:ring-offset-2 hover:text-[#a3947e]">
                                    <span>Upload files</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple accept="image/*" @change="handleFileChange" />
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                     <div v-if="form.errors.images" class="mt-1 text-sm text-red-500">{{ form.errors.images }}</div>
                </div>

                <!-- Preview New Images -->
                <div v-if="previewImages.length > 0" class="grid grid-cols-3 gap-4">
                    <div v-for="(src, index) in previewImages" :key="index" class="relative aspect-square">
                        <img :src="src" class="h-full w-full rounded object-cover" />
                    </div>
                </div>

                <!-- Existing Images (Edit Only) -->
                <div v-if="project && project.images.length > 0">
                    <h3 class="mt-6 text-lg font-bold">Existing Images</h3>
                    <p class="text-xs text-gray-400 mb-2">First image is the cover.</p>
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                        <div v-for="(image, index) in project.images" :key="image.id" class="group relative aspect-square">
                            <img :src="'/storage/' + image.image_path" class="h-full w-full rounded object-cover" />
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 transition-opacity group-hover:opacity-100">
                                <button type="button" @click="deleteImage(image.id)" class="rounded bg-red-600 px-2 py-1 text-xs text-white">Delete</button>
                            </div>
                            <div v-if="index === 0" class="absolute left-0 top-0 rounded-br bg-[#B5A58D] px-2 py-1 text-xs font-bold text-gray-900">
                                Cover
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end pt-5">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded bg-[#B5A58D] px-6 py-2 font-bold text-gray-900 hover:bg-[#a3947e] disabled:opacity-50"
                    >
                        {{ isEditing ? 'Save Changes' : 'Create Project' }}
                    </button>
                </div>
            </form>
        </main>
    </div>
</template>
