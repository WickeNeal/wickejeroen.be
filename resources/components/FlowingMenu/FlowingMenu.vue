<!--
	Installed from https://vue-bits.dev/ui/
-->

<template>
    <div class="h-full w-full overflow-hidden">
        <nav class="m-0 flex h-full flex-col p-0">
            <div
                v-for="(item, idx) in items"
                :key="idx"
                class="relative flex-1 overflow-hidden text-center shadow-[0_-1px_0_0_#fff]"
                :ref="(el) => setItemRef(el as HTMLDivElement, idx)"
            >
          <a
            class="flex items-center justify-center h-full relative cursor-pointer uppercase no-underline font-semibold text-[4vh] hover:text-[#0b0b0b] focus-visible:text-[#0b0b0b]"
            :href="item.link"
            @mouseenter="ev => handleMouseEnter(ev, idx)"
            @mouseleave="ev => handleMouseLeave(ev, idx)"
          >
            {{ item.text }}
          </a>

          <div
            class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none translate-y-[101%] bg-cover bg-center"
            :style="{ backgroundImage: `url(${item.image})` }"
            :ref="el => (marqueeRefs[idx] = el as HTMLDivElement)"
          >
            <div class="absolute inset-0 bg-black opacity-70"></div>
            <div class="h-full w-[200%] flex" :ref="el => (marqueeInnerRefs[idx] = el as HTMLDivElement)">
              <div 
                class="flex items-center relative h-full w-max will-change-transform animate-marquee backface-hidden transform-gpu"
                :ref="el => (marqueeContentRefs[idx] = el as HTMLDivElement)"
              >
                <template v-for="i in 2" :key="`${idx}-${i}`">
                  <div class="flex items-center justify-center p-[1vh_1vw_0] whitespace-nowrap flex-shrink-0">
                    <p class=" uppercase font-semibold text-[4vh] leading-[1.2] mr-[1vw]">
                      {{ item.description }}
                    </p>
                  </div>
                </template>
              </div>
            </div>
          </div>
            </div>
        </nav>
    </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';
import { gsap } from 'gsap';
import { useWindowSize } from '@vueuse/core';

interface MenuItemProps {
  link: string;
  text: string;
  image: string;
  icon?: string;
  description?: string;
}
interface Props {
    items?: MenuItemProps[];
}

const props = withDefaults(defineProps<Props>(), {
    items: () => [],
});

const itemRefs = ref<(HTMLDivElement | null)[]>([]);
const marqueeRefs = ref<(HTMLDivElement | null)[]>([]);
const marqueeInnerRefs = ref<(HTMLDivElement | null)[]>([]);
const marqueeContentRefs = ref<(HTMLDivElement | null)[]>([]);

const animationDefaults = { duration: 0.6, ease: 'expo' };

const setItemRef = (el: HTMLDivElement | null, idx: number) => {
    if (el) {
        itemRefs.value[idx] = el;
    }
};

const findClosestEdge = (mouseX: number, mouseY: number, width: number, height: number): 'top' | 'bottom' => {
    const topEdgeDist = Math.pow(mouseX - width / 2, 2) + Math.pow(mouseY, 2);
    const bottomEdgeDist = Math.pow(mouseX - width / 2, 2) + Math.pow(mouseY - height, 2);
    return topEdgeDist < bottomEdgeDist ? 'top' : 'bottom';
};

const { width: windowWidth, height: windowHeight } = useWindowSize();

const animateIn = (idx: number, fromTop: boolean) => {
    const marqueeRef = marqueeRefs.value[idx];
    const marqueeInnerRef = marqueeInnerRefs.value[idx];
    const marqueeContentRef = marqueeContentRefs.value[idx];

    if (!marqueeRef || !marqueeInnerRef) return;
    
    // Reset Marquee Animation
    if (marqueeContentRef) {
        marqueeContentRef.style.animation = 'none';
        void marqueeContentRef.offsetHeight; // Trigger Reflow
        marqueeContentRef.style.animation = ''; // Re-enable standard CSS animation
    }

    // Kill existing animations to prevent conflicts
    gsap.killTweensOf([marqueeRef, marqueeInnerRef]);

    const tl = gsap.timeline({ defaults: animationDefaults });
    tl.set(marqueeRef, { y: fromTop ? '-101%' : '101%' })
        .set(marqueeInnerRef, { y: fromTop ? '101%' : '-101%' })
        .to([marqueeRef, marqueeInnerRef], { y: '0%' });
};

const animateOut = (idx: number, fromTop: boolean) => {
    const marqueeRef = marqueeRefs.value[idx];
    const marqueeInnerRef = marqueeInnerRefs.value[idx];
    if (!marqueeRef || !marqueeInnerRef) return;

    // Kill existing animations
    gsap.killTweensOf([marqueeRef, marqueeInnerRef]);

    const tl = gsap.timeline({ defaults: animationDefaults });
    tl.to(marqueeRef, { y: fromTop ? '-101%' : '101%' }).to(marqueeInnerRef, {
        y: fromTop ? '101%' : '-101%',
    }, "<"); // Run concurrently
};

const handleMouseEnter = (ev: MouseEvent, idx: number) => {
    if (windowWidth.value < 1024) return; // Disable hover on mobile/tablet (rely on scroll)
    const itemRef = itemRefs.value[idx];
    if (!itemRef) return;
    const rect = itemRef.getBoundingClientRect();
    const edge = findClosestEdge(ev.clientX - rect.left, ev.clientY - rect.top, rect.width, rect.height);
    animateIn(idx, edge === 'top');
};

const handleMouseLeave = (ev: MouseEvent, idx: number) => {
    if (windowWidth.value < 1024) return;
    const itemRef = itemRefs.value[idx];
    if (!itemRef) return;
    const rect = itemRef.getBoundingClientRect();
    const edge = findClosestEdge(ev.clientX - rect.left, ev.clientY - rect.top, rect.width, rect.height);
    animateOut(idx, edge === 'top');
};

// Scroll Trigger Logic
const activeItemIndex = ref(-1);

const checkScroll = () => {
    if (windowWidth.value >= 1024) return; // Only for mobile/tablet

    const center = windowHeight.value / 2;
    // Sweet spot: 15% above/below center
    const range = windowHeight.value * 0.15; 

    props.items.forEach((_, idx) => {
        const itemRef = itemRefs.value[idx];
        if (itemRef) {
            const rect = itemRef.getBoundingClientRect();
            const itemCenter = rect.top + rect.height / 2;
            
            // Check if item center is within sweet spot
            if (itemCenter >= center - range && itemCenter <= center + range) {
                if (activeItemIndex.value !== idx) {
                    // New item calling dibs
                    const direction = itemCenter > center ? false : true; // Determine direction roughly
                    animateIn(idx, true); // Always slide in from top for consistency or calculate scroll dir
                    activeItemIndex.value = idx;
                }
            } else if (activeItemIndex.value === idx) {
                // Leaving sweet spot
                animateOut(idx, true);
                activeItemIndex.value = -1;
            }
        }
    });
};

// Use simple RAF loop or scroll listener for performance
// Since useWindowScroll is reactive, we can watch it or just use a standard listener
let scrollCleanup: (() => void) | null = null;

onMounted(() => {
    scrollCleanup = () => window.removeEventListener('scroll', checkScroll);
    window.addEventListener('scroll', checkScroll, { passive: true });
});

onUnmounted(() => {
    if (scrollCleanup) scrollCleanup();
});
</script>

<style scoped>
@keyframes marquee {
    from {
        transform: translateX(0%);
    }

    to {
        transform: translateX(-50%);
    }
}

.animate-marquee {
    animation: marquee 15s linear infinite;
}

.backface-hidden {
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
}

.transform-gpu {
    transform: translateZ(0);
    -webkit-transform: translateZ(0);
}
</style>
