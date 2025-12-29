<template>
    <header 
        :class="[
            'fixed top-0 left-0 w-full z-50 flex items-center justify-between md:justify-center whitespace-nowrap px-6 py-4 md:px-10 lg:px-20 transition-all duration-300 ease-in-out',
            { 
                '-translate-y-full': !isHeaderVisible,
                'bg-background-dark/40 backdrop-blur-sm shadow-sm': isScrolled && !isMobileMenuOpen,
                'duration-0 opacity-0 pointer-events-none': isMobileMenuOpen
            }
        ]"
        active-section-index=""
    >
        <div class="hidden md:flex items-center justify-center gap-12">
            <GooeyNav
              :items="leftNavItems"
              :animation-time="600"
              :particle-count="5"
              :particle-distances="[90, 10]"
              :particle-r="100"
              :time-variance="300"
              :colors="[1, 2, 3, 1, 2, 3, 1, 4]"
              :active-index="leftActiveIndex"
            />
            
            <a href="/" class="shrink-0 relative z-50">
                 <img src="/images/Wicke Jeroen logo/6.png" alt="Logo" class="h-20 w-auto object-contain drop-shadow-md transform hover:scale-105 transition-transform duration-300">
            </a>

            <GooeyNav
              :items="rightNavItems"
              :animation-time="600"
              :particle-count="5"
              :particle-distances="[90, 10]"
              :particle-r="100"
              :time-variance="300"
              :colors="[1, 2, 3, 1, 2, 3, 1, 4]"
              :active-index="rightActiveIndex"
            />
        </div>

        <!-- Logo (Top Left) - Visible mostly on mobile -->
        <!-- Logo (Top Left) - Visible mostly on mobile -->
        <a href="/" class="md:hidden z-50">
            <img src="/images/Wicke Jeroen logo/6.png" alt="Logo" class="h-20 w-auto object-contain drop-shadow-md">
        </a>
        
        <!-- Mobile Menu Button (Top Right) -->
        <button 
            @click="toggleMobileMenu"
            class="md:hidden z-50 h-10 w-10 flex items-center justify-center cursor-pointer transition-transform active:scale-95 text-white drop-shadow-md"
        >
            <span class="material-symbols-outlined text-4xl leading-none select-none">menu</span>
        </button>

        <!-- Mobile Menu Overlay -->
        <Teleport to="body">
            <Transition
                enter-active-class="transition duration-300 ease-out"
                enter-from-class="opacity-0 -translate-y-4"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-200 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-4"
            >
                <div 
                    v-if="isMobileMenuOpen" 
                    class="md:hidden fixed inset-0 z-[100] bg-background-dark/95 backdrop-blur-sm flex flex-col items-center justify-center"
                >
                    <div class="w-full max-w-sm px-6">
                        <ul class="flex flex-col space-y-4 text-center">
                            <li v-for="item in navItems" :key="item.label">
                                <a 
                                    :href="item.href" 
                                    @click="closeMobileMenu"
                                    class="block py-4 text-2xl font-display font-bold text-background-light hover:text-primary transition-colors uppercase tracking-wider"
                                >
                                    {{ item.label }}
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Close button -->
                        <button 
                            @click="closeMobileMenu"
                            class="mt-12 mx-auto text-white/50 hover:text-white transition-colors w-full flex justify-center"
                        >
                             <span class="material-symbols-outlined text-4xl">close</span>
                        </button>
                    </div>
                </div>
            </Transition>
        </Teleport>
    </header>
</template>
<script setup lang="ts">
import GooeyNav from "../../components/GooeyNav/GooeyNav.vue";
import { ref, onMounted, onUnmounted, computed, watch } from 'vue';
import { useWindowScroll, useMouse, useWindowSize } from '@vueuse/core';

const props = defineProps<{
  activeSectionIndex: number;
}>();

const { y: scrollY } = useWindowScroll();
const { y: mouseY } = useMouse();
const { width: windowWidth } = useWindowSize();

const isHeaderVisible = ref(true);
const isScrolled = computed(() => scrollY.value > 20);
const lastScrollY = ref(0);

// Combine scroll and hover logic
// Combine scroll and hover logic
watch([scrollY, mouseY], ([newY, newMouseY]) => {
    // Calculate clientY (mouse position relative to viewport)
    // mouseY from useMouse is typically pageY (document coordinates)
    const clientY = newMouseY - newY;

    // Desktop Hover Reveal: If mouse is at top of viewport (e.g. < 50px)
    // We use a smaller threshold for the "trigger" to avoid accidental showing
    const isHoveringTop = windowWidth.value >= 768 && clientY < 100 && clientY >= 0;

    if (isHoveringTop) {
        isHeaderVisible.value = true;
    } 
    
    // Scroll Logic
    if (newY <= 0) {
        // Always show at top
        isHeaderVisible.value = true;
    } else if (newY > lastScrollY.value && newY > 50) {
        // Scrolling down & past threshold -> Hide
        // Only hide if we are NOT hovering at the top (on desktop)
        if (!isHoveringTop) {
             isHeaderVisible.value = false;
        }
    } else if (newY < lastScrollY.value) {
        // Scrolling up -> Show
        isHeaderVisible.value = true;
    }
    lastScrollY.value = newY;
});

const navItems = [
  { label: 'Home', href: '#home' },
  { label: 'Diensten', href: '#diensten' },
  { label: 'Realisaties', href: '#realisaties' },
  { label: 'Contact', href: '#contact' }
];

const leftNavItems = computed(() => navItems.slice(0, 2));
const rightNavItems = computed(() => navItems.slice(2));

// Calculate active index for left menu (0 or 1, else -1)
const leftActiveIndex = computed(() => {
    if (props.activeSectionIndex !== undefined && props.activeSectionIndex < 2 && props.activeSectionIndex >= 0) {
        return props.activeSectionIndex;
    }
    return -1;
});

// Calculate active index for right menu (offset by 2)
const rightActiveIndex = computed(() => {
    if (props.activeSectionIndex !== undefined && props.activeSectionIndex >= 2 && props.activeSectionIndex < 4) {
        return props.activeSectionIndex - 2;
    }
    return -1;
});

const isMobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
};

// Close menu on scroll
const handleScroll = () => {
    if (isMobileMenuOpen.value) {
        closeMobileMenu();
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
