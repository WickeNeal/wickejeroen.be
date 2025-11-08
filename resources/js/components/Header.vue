<template>
    <header
        class="fixed top-0 left-0 z-50 flex w-full items-center justify-center px-6 py-4 whitespace-nowrap md:px-10 lg:px-20"
        active-section-index=""
    >
        <GooeyNav
            :items="navItems"
            :animation-time="600"
            :particle-count="5"
            :particle-distances="[90, 10]"
            :particle-r="100"
            :time-variance="300"
            :colors="[1, 2, 3, 1, 2, 3, 1, 4]"
            :active-index="activeSectionIndex"
        />
        <button class="text-text-light dark:text-text-dark md:hidden">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
    </header>
</template>
<script setup lang="ts">
import { defineProps } from 'vue';
import GooeyNav from '../../components/GooeyNav/GooeyNav.vue';

defineProps<{
    activeSectionIndex: number;
}>();

const navItems = [
    { label: 'Home', href: '#home' },
    { label: 'Diensten', href: '#diensten' },
    { label: 'Realisaties', href: '#realisaties' },
    { label: 'Contact', href: '#contact' },
];
</script>
