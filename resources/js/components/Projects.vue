<template>
    <section class="bg-background pt-20 pb-20" id="realisaties">
        <div class="container mx-auto px-4">
            <h2 class="text-center font-display text-4xl font-bold uppercase tracking-wider text-text-light dark:text-primary md:text-5xl mb-12">
                Onze Realisaties
            </h2>
            <Masonry
                :items="masonryItems"
                :columns="3"
                :gap="20"
            />
        </div>
    </section>
</template>

<script setup lang="ts">
import Masonry from '../../components/Masonry/Masonry.vue';
import { computed } from 'vue';

const props = defineProps<{
    projects: Array<{
        id: number;
        title: string;
        slug: string;
        cover_image_path: string;
    }>;
}>();

const masonryItems = computed(() => {
    const heights = [400, 550, 350, 500, 450];
    return props.projects.map((project, index) => ({
        id: String(project.id),
        img: '/storage/' + project.cover_image_path,
        url: `/realisaties/${project.slug}`,
        height: heights[index % heights.length],
        title: project.title,
        label: project.title
    }));
});
</script>
