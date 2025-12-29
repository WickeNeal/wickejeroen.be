<template>
    <PublicLayout :show-header="false">
        <div class="bg-background min-h-screen pt-10 pb-20">
            <div class="container mx-auto px-4">
                <div v-if="project">
                    <div class="mb-12 text-center">
                        <img src="/images/Wicke Jeroen logo/6.png" alt="Logo" class="h-24 w-auto mx-auto mb-8 object-contain">
                        <Link href="/#realisaties" class="text-primary hover:underline mb-8 inline-block">&larr; Terug naar overzicht</Link>
                        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">{{ project.title }}</h1>
                        <p class="text-xl text-gray-400 max-w-2xl mx-auto">{{ project.description }}</p>
                    </div>
                    
                    <div class="w-full">
                         <Masonry
                            :items="masonryItems"
                            :columns="3"
                            :gap="16"
                            :s-r-l="true"
                        />
                    </div>
                </div>
                <div v-else class="text-center text-white pt-20">
                    <h1 class="text-4xl font-bold mb-4">Project niet gevonden</h1>
                    <Link href="/#realisaties" class="text-primary hover:underline">Terug naar overzicht</Link>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup lang="ts">
import PublicLayout from "@/layouts/PublicLayout.vue";
import Masonry from '../../components/Masonry/Masonry.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    project: {
        title: string;
        description: string;
        images: Array<{
            id: number;
            image_path: string;
        }>;
    };
}>();

const masonryItems = computed(() => {
    if (!props.project) return [];
    return props.project.images.map((img, index) => ({
        id: `img-${index}`,
        img: '/storage/' + img.image_path,
        url: '/storage/' + img.image_path, // For lightbox if enabled
        height: 300 + Math.random() * 200
    }));
});
</script>
