<!--
	Installed from https://vue-bits.dev/ui/
-->

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, computed, useTemplateRef } from 'vue';
import { gsap } from 'gsap';

interface GridMotionProps {
    items?: string[];
    gradientColor?: string;
}

const props = withDefaults(defineProps<GridMotionProps>(), {
    items: () => [],
    gradientColor: '#222222',
});

const gridRef = useTemplateRef<HTMLElement>('gridRef');
const rowRefs = ref<HTMLElement[]>([]);
const mouseX = ref(window.innerWidth / 2);

const totalItems = 150;
const combinedItems = computed(() => {
    if (props.items.length === 0) {
        return [];
    }

    const repeatedItems = [];
    for (let i = 0; i < totalItems; i++) {
        repeatedItems.push(props.items[i % props.items.length]);
    }
    return repeatedItems;
});

function isImage(item: string) {
    return typeof item === 'string' && item.startsWith('http');
}

function isTag(item: string) {
    return typeof item === 'string' && item.startsWith('<') && item.endsWith('>');
}

onMounted(() => {
    gsap.ticker.lagSmoothing(0);

    const handleMouseMove = (e: MouseEvent) => {
        mouseX.value = e.clientX;
    };

    const updateMotion = () => {
        const maxMoveAmount = 300;
        const baseDuration = 0.8;
        const inertiaFactors = [0.6, 0.4, 0.3, 0.2];

        rowRefs.value.forEach((row, index) => {
            const direction = index % 2 === 0 ? 1 : -1;
            const moveAmount = ((mouseX.value / window.innerWidth) * maxMoveAmount - maxMoveAmount / 2) * direction;

            gsap.to(row, {
                x: moveAmount,
                duration: baseDuration + inertiaFactors[index % inertiaFactors.length],
                ease: 'power3.out',
                overwrite: 'auto',
            });
        });
    };

    const removeAnimation = gsap.ticker.add(updateMotion);
    window.addEventListener('mousemove', handleMouseMove);

    onBeforeUnmount(() => {
        window.removeEventListener('mousemove', handleMouseMove);
        removeAnimation();
    });
});
</script>

<template>
    <div ref="gridRef" class="h-full w-full overflow-hidden">
        <section
            class="relative flex h-screen w-full items-center justify-center overflow-hidden"
            :style="{
                background: `radial-gradient(circle, ${gradientColor} 0%, transparent 100%)`,
                backgroundPosition: 'center',
            }"
        >
            <div class="pointer-events-none absolute inset-0 z-[4] bg-[length:250px]"></div>

            <div class="relative z-[2] grid h-[150vh] w-[150vw] flex-none origin-center rotate-[-15deg] grid-cols-1 gap-4">
                <div v-for="rowIndex in 10" :key="rowIndex" class="flex gap-4" :style="{ willChange: 'transform, filter' }" ref="rowRefs">
                    <div
                        v-for="itemIndex in 15"
                        :key="itemIndex"
                        class="relative h-[250px] min-w-[300px] flex-shrink-0"
                        v-show="combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)]"
                    >
                        <div
                            class="relative flex h-full w-full items-center justify-center overflow-hidden rounded-[10px] bg-[#111] text-[1.5rem] text-white"
                        >
                            <div
                                v-if="isImage(combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)])"
                                class="absolute top-0 left-0 h-full w-full bg-cover bg-center"
                                :style="{
                                    backgroundImage: `url(${combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)]})`,
                                }"
                            ></div>

                            <div
                                v-else-if="isTag(combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)])"
                                class="z-[2] p-4 text-center"
                                v-html="combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)]"
                            ></div>

                            <div v-else class="z-[1] p-4 text-center">
                                {{ combinedItems[(rowIndex - 1) * 15 + (itemIndex - 1)] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pointer-events-none relative top-0 left-0 h-full w-full"></div>
        </section>
    </div>
</template>
