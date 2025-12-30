```vue
<template>
    <PublicLayout :show-header="false">
        <!-- Floating Logo Home Link -->
        <a href="/" class="fixed top-4 left-1/2 -translate-x-1/2 md:top-6 z-50 transition-transform hover:scale-105">
            <img src="/images/Wicke Jeroen logo/6.png" alt="Wicke Jeroen" class="h-20 w-auto object-contain drop-shadow-md">
        </a>
        
        <div class="bg-background min-h-screen pt-32 pb-20">
            <div class="container mx-auto px-4">
                <div v-if="project">
                    <div class="mb-12 text-center">
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
                            @item-click="openLightbox"
                        />
                    </div>
                </div>
                <div v-else class="text-center text-white pt-20">
                    <h1 class="text-4xl font-bold mb-4">Project niet gevonden</h1>
                    <Link href="/#realisaties" class="text-primary hover:underline">Terug naar overzicht</Link>
                </div>
            </div>
        </div>

        <!-- Lightbox Overlay -->
        <div v-if="lightboxOpen" ref="lightboxContainer" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-95 p-4" @click.self="closeLightbox">
            <button @click="closeLightbox" class="absolute top-4 right-4 text-white hover:text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <button @click="prevImage" class="absolute left-4 text-white hover:text-gray-300 hidden md:block">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>

            <div class="relative max-h-[90vh] max-w-[90vw]">
                <img :src="'/storage/' + project.images[currentImageIndex].image_path" class="max-h-[85vh] max-w-full object-contain rounded shadow-2xl" />
                <div class="mt-2 text-center text-gray-400 text-sm">
                    {{ currentImageIndex + 1 }} / {{ project.images.length }}
                </div>
            </div>

            <button @click="nextImage" class="absolute right-4 text-white hover:text-gray-300 hidden md:block">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </PublicLayout>
</template>

<script setup lang="ts">
import PublicLayout from "@/layouts/PublicLayout.vue";
import Masonry from '../../components/Masonry/Masonry.vue';
import { Link } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';
import { useSwipe } from '@vueuse/core';

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

const lightboxOpen = ref(false);
const currentImageIndex = ref(0);
const lightboxContainer = ref<HTMLElement | null>(null);

useSwipe(lightboxContainer, {
    onSwipeEnd(e: TouchEvent, direction: string) {
        if (direction === 'LEFT') nextImage();
        if (direction === 'RIGHT') prevImage();
        // Prevent scrolling underneath
        e?.preventDefault();
    },
});

const masonryItems = computed(() => {
    if (!props.project) return [];
    return props.project.images.map((img, index) => ({
        id: `img-${index}`,
        img: '/storage/' + img.image_path,
        url: '', // Empty URL to prevent default navigation
        originalIndex: index,
        height: 300 + Math.random() * 200
    }));
});

const openLightbox = (item: any) => {
    currentImageIndex.value = item.originalIndex;
    lightboxOpen.value = true;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    lightboxOpen.value = false;
    document.body.style.overflow = '';
};

const nextImage = () => {
    if (currentImageIndex.value < props.project.images.length - 1) {
        currentImageIndex.value++;
    } else {
        currentImageIndex.value = 0;
    }
};

const prevImage = () => {
    if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
    } else {
        currentImageIndex.value = props.project.images.length - 1;
    }
};

onMounted(() => {
    window.addEventListener('keydown', (e) => {
        if (!lightboxOpen.value) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
});
</script>
