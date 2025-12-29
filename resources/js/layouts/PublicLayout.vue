<template>
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <Header v-if="showHeader" :active-section-index="activeSectionIndex" />
        <main class="relative z-10 flex-grow">
            <slot />
        </main>
        <Footer />
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue";

const props = withDefaults(defineProps<{
    showHeader?: boolean;
}>(), {
    showHeader: true
});

const activeSectionIndex = ref(0);

const sectionIds = ['home', 'diensten', 'realisaties', 'contact'];

const handleScroll = () => {
    const scrollY = window.scrollY;
    const offset = 100; // Adjust this value as needed for better active state detection

    // Explicitly handle "at the top" case to avoid sticking
    if (scrollY < 50) {
        activeSectionIndex.value = 0;
        return;
    }

    const viewportHeight = window.innerHeight;
    const triggerPoint = viewportHeight * 0.4; // Trigger when section is 40% up the screen (near center)

    for (let i = sectionIds.length - 1; i >= 0; i--) {
        const section = document.getElementById(sectionIds[i]);
        if (section) {
            const rect = section.getBoundingClientRect();
            // check if the top of the section is above the trigger point
            if (rect.top <= triggerPoint) {
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