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
                    class="relative flex h-full cursor-pointer items-center justify-center text-[4vh] font-semibold text-white uppercase no-underline hover:text-[#0b0b0b] focus:text-white focus-visible:text-[#0b0b0b]"
                    :href="item.link"
                    @mouseenter="(ev) => handleMouseEnter(ev, idx)"
                    @mouseleave="(ev) => handleMouseLeave(ev, idx)"
                >
                    {{ item.text }}
                </a>

                <div
                    class="pointer-events-none absolute top-0 left-0 h-full w-full translate-y-[101%] overflow-hidden bg-white"
                    :ref="(el) => (marqueeRefs[idx] = el as HTMLDivElement)"
                >
                    <div class="flex h-full w-[200%]" :ref="(el) => (marqueeInnerRefs[idx] = el as HTMLDivElement)">
                        <div class="animate-marquee relative flex h-full w-[200%] items-center will-change-transform">
                            <template v-for="i in 4" :key="`${idx}-${i}`">
                                <span class="p-[1vh_1vw_0] text-[4vh] leading-[1.2] font-normal text-[#0b0b0b] uppercase">
                                    {{ item.text }}
                                </span>

                                <div
                                    class="mx-[2vw] my-[2em] h-[7vh] w-[200px] rounded-[50px] bg-cover bg-center p-[1em_0]"
                                    :style="{ backgroundImage: `url(${item.image})` }"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { gsap } from 'gsap';

interface MenuItemProps {
    link: string;
    text: string;
    image: string;
}

interface Props {
    items?: MenuItemProps[];
}

withDefaults(defineProps<Props>(), {
    items: () => [],
});

const itemRefs = ref<(HTMLDivElement | null)[]>([]);
const marqueeRefs = ref<(HTMLDivElement | null)[]>([]);
const marqueeInnerRefs = ref<(HTMLDivElement | null)[]>([]);

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

const handleMouseEnter = (ev: MouseEvent, idx: number) => {
    const itemRef = itemRefs.value[idx];
    const marqueeRef = marqueeRefs.value[idx];
    const marqueeInnerRef = marqueeInnerRefs.value[idx];

    if (!itemRef || !marqueeRef || !marqueeInnerRef) return;

    const rect = itemRef.getBoundingClientRect();
    const edge = findClosestEdge(ev.clientX - rect.left, ev.clientY - rect.top, rect.width, rect.height);

    const tl = gsap.timeline({ defaults: animationDefaults });
    tl.set(marqueeRef, { y: edge === 'top' ? '-101%' : '101%' })
        .set(marqueeInnerRef, { y: edge === 'top' ? '101%' : '-101%' })
        .to([marqueeRef, marqueeInnerRef], { y: '0%' });
};

const handleMouseLeave = (ev: MouseEvent, idx: number) => {
    const itemRef = itemRefs.value[idx];
    const marqueeRef = marqueeRefs.value[idx];
    const marqueeInnerRef = marqueeInnerRefs.value[idx];

    if (!itemRef || !marqueeRef || !marqueeInnerRef) return;

    const rect = itemRef.getBoundingClientRect();
    const edge = findClosestEdge(ev.clientX - rect.left, ev.clientY - rect.top, rect.width, rect.height);

    const tl = gsap.timeline({ defaults: animationDefaults });
    tl.to(marqueeRef, { y: edge === 'top' ? '-101%' : '101%' }).to(marqueeInnerRef, {
        y: edge === 'top' ? '101%' : '-101%',
    });
};
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
</style>
