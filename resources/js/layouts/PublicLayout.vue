<template>
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <Header :active-section-index="activeSectionIndex" />
        <main class="relative z-10 flex-grow">
            <slot />
        </main>
        <Footer />
    </div>
</template>

<script setup lang="ts">
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import { onMounted, onUnmounted, ref } from 'vue';

const activeSectionIndex = ref(0);

const sectionIds = ['home', 'diensten', 'realisaties', 'contact'];

const handleScroll = () => {
    const scrollY = window.scrollY;
    const offset = 100; // Adjust this value as needed for better active state detection

    for (let i = sectionIds.length - 1; i >= 0; i--) {
        const section = document.getElementById(sectionIds[i]);
        if (section) {
            if (scrollY + offset >= section.offsetTop) {
                activeSectionIndex.value = i;
                break;
            }
        }
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Call once on mount to set initial active section
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
