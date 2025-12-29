<template>
    <section class="bg-background pt-20 pb-20" id="realisaties">
        <div class="container mx-auto px-4">
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
    return props.projects.map((project) => ({
        id: String(project.id),
        img: '/storage/' + project.cover_image_path,
        url: `/realisaties/${project.slug}`,
        height: 400,
        title: project.title,
        label: project.title
    }));
});
</script>
