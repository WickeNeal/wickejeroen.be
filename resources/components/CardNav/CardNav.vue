<!--
	Installed from https://vue-bits.dev/ui/
-->

<script setup lang="ts">
import { gsap } from 'gsap';
import { nextTick, onBeforeUpdate, onMounted, onUnmounted, ref, watch, type VNodeRef } from 'vue';

type CardNavLink = {
    label: string;
    href?: string;
    ariaLabel: string;
};

export type CardNavItem = {
    label: string;
    bgColor: string;
    textColor: string;
    links: CardNavLink[];
};

export interface CardNavProps {
    logo: string;
    logoAlt?: string;
    items: CardNavItem[];
    className?: string;
    ease?: string;
    baseColor?: string;
    menuColor?: string;
    buttonBgColor?: string;
    buttonTextColor?: string;
}

const props = withDefaults(defineProps<CardNavProps>(), {
    logoAlt: 'Logo',
    className: '',
    ease: 'power3.out',
    baseColor: '#fff',
});

const isHamburgerOpen = ref(false);
const isExpanded = ref(false);

const navRef = ref<HTMLDivElement | null>(null);
const cardsRef = ref<HTMLDivElement[]>([]);
const tlRef = ref<gsap.core.Timeline | null>(null);

const setCardRef =
    (i: number): VNodeRef =>
    (el) => {
        if (el && el instanceof HTMLDivElement) {
            cardsRef.value[i] = el;
        }
    };

onBeforeUpdate(() => {
    cardsRef.value = [];
});

const calculateHeight = () => {
    const navEl = navRef.value;
    if (!navEl) return 260;

    const isMobile = window.matchMedia('(max-width: 768px)').matches;
    if (isMobile) {
        const contentEl = navEl.querySelector('.card-nav-content') as HTMLElement;
        if (contentEl) {
            const wasVisible = contentEl.style.visibility;
            const wasPosition = contentEl.style.position;
            const wasHeight = contentEl.style.height;

            contentEl.style.visibility = 'visible';
            contentEl.style.position = 'static';
            contentEl.style.height = 'auto';

            const topBar = 60;
            const padding = 16;
            const contentHeight = contentEl.scrollHeight;

            contentEl.style.visibility = wasVisible;
            contentEl.style.position = wasPosition;
            contentEl.style.height = wasHeight;

            return topBar + contentHeight + padding;
        }
    }
    return 260;
};

const createTimeline = () => {
    const navEl = navRef.value;
    if (!navEl) return null;

    gsap.set(navEl, { height: 60, overflow: 'hidden' });
    gsap.set(cardsRef.value, { y: 50, opacity: 0 });

    const tl = gsap.timeline({ paused: true });

    tl.to(navEl, {
        height: calculateHeight,
        duration: 0.4,
        ease: props.ease,
    });

    tl.to(cardsRef.value, { y: 0, opacity: 1, duration: 0.4, ease: props.ease, stagger: 0.08 }, '-=0.1');

    return tl;
};

const toggleMenu = () => {
    const tl = tlRef.value;
    if (!tl) return;
    if (!isExpanded.value) {
        isHamburgerOpen.value = true;
        isExpanded.value = true;
        nextTick(() => {
            tl.play(0);
        });
    } else {
        isHamburgerOpen.value = false;
        tl.eventCallback('onReverseComplete', () => {
            isExpanded.value = false;
            tl.eventCallback('onReverseComplete', null);
        });
        tl.reverse();
    }
};

const handleResize = () => {
    if (!tlRef.value) return;

    if (isExpanded.value) {
        const newHeight = calculateHeight();
        gsap.set(navRef.value, { height: newHeight });

        tlRef.value.kill();
        const newTl = createTimeline();
        if (newTl) {
            newTl.progress(1);
            tlRef.value = newTl;
        }
    } else {
        tlRef.value.kill();
        tlRef.value = createTimeline();
    }
};

onMounted(() => {
    tlRef.value = createTimeline();
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    tlRef.value?.kill();
    tlRef.value = null;
    window.removeEventListener('resize', handleResize);
});

watch(
    () => [props.ease, props.items],
    () => {
        nextTick(() => {
            if (tlRef.value) tlRef.value.kill();
            tlRef.value = createTimeline();
        });
    },
);
</script>

<template>
    <div :class="`card-nav-container absolute top-[1.2em] left-1/2 z-[99] w-[90%] max-w-[800px] -translate-x-1/2 md:top-[2em] ${props.className}`">
        <nav
            ref="navRef"
            :class="['card-nav relative block h-[60px] overflow-hidden rounded-xl p-0 shadow-md will-change-[height]', { open: isExpanded }]"
            :style="{ backgroundColor: props.baseColor }"
        >
            <div class="card-nav-top absolute inset-x-0 top-0 z-[2] flex h-[60px] items-center justify-between p-2 px-[1.1rem]">
                <div
                    :class="[
                        'hamburger-menu group order-2 flex h-full cursor-pointer flex-col items-center justify-center gap-[6px] md:order-none',
                        { open: isHamburgerOpen },
                    ]"
                    @click="toggleMenu"
                    role="button"
                    :aria-label="isExpanded ? 'Close menu' : 'Open menu'"
                    tabindex="0"
                    :style="{ color: props.menuColor || '#000' }"
                >
                    <div
                        :class="[
                            'hamburger-line h-[2px] w-[30px] [transform-origin:50%_50%] bg-current transition-[transform,opacity,margin] duration-300 ease-linear group-hover:opacity-75',
                            { 'translate-y-[4px] rotate-45': isHamburgerOpen },
                        ]"
                    />
                    <div
                        :class="[
                            'hamburger-line h-[2px] w-[30px] [transform-origin:50%_50%] bg-current transition-[transform,opacity,margin] duration-300 ease-linear group-hover:opacity-75',
                            { '-translate-y-[4px] -rotate-45': isHamburgerOpen },
                        ]"
                    />
                </div>

                <div
                    class="logo-container order-1 flex items-center md:absolute md:top-1/2 md:left-1/2 md:order-none md:-translate-x-1/2 md:-translate-y-1/2"
                >
                    <img :src="props.logo" :alt="props.logoAlt" class="logo h-[28px]" />
                </div>

                <button
                    type="button"
                    class="card-nav-cta-button hidden h-full cursor-pointer rounded-[calc(0.75rem-0.2rem)] border-0 px-4 py-2 font-medium transition-colors duration-300 md:inline-flex"
                    :style="{
                        backgroundColor: props.buttonBgColor,
                        color: props.buttonTextColor,
                    }"
                >
                    Get Started
                </button>
            </div>

            <div
                :class="[
                    'card-nav-content absolute top-[60px] right-0 bottom-0 left-0 z-[1] flex flex-col items-stretch justify-start gap-2 p-2 md:flex-row md:items-end md:gap-[12px]',
                    isExpanded ? 'pointer-events-auto visible' : 'pointer-events-none invisible',
                ]"
                :aria-hidden="!isExpanded"
            >
                <div
                    v-for="(item, idx) in (props.items || []).slice(0, 3)"
                    :key="`${item.label}-${idx}`"
                    :ref="setCardRef(idx)"
                    class="nav-card relative flex h-auto min-h-[60px] min-w-0 flex-[1_1_auto] flex-col gap-2 rounded-[calc(0.75rem-0.2rem)] p-[12px_16px] select-none md:h-full md:min-h-0 md:flex-[1_1_0%]"
                    :style="{ backgroundColor: item.bgColor, color: item.textColor }"
                >
                    <div class="nav-card-label text-[18px] font-normal tracking-[-0.5px] md:text-[22px]">
                        {{ item.label }}
                    </div>
                    <div class="nav-card-links mt-auto flex flex-col gap-[2px]">
                        <a
                            v-for="(lnk, i) in item.links"
                            :key="`${lnk.label}-${i}`"
                            class="nav-card-link inline-flex cursor-pointer items-center gap-[6px] text-[15px] no-underline transition-opacity duration-300 hover:opacity-75 md:text-[16px]"
                            :href="lnk.href"
                            :aria-label="lnk.ariaLabel"
                        >
                            <v-icon name="go-arrow-up-right" class="nav-card-link-icon shrink-0" aria-hidden="true" />
                            {{ lnk.label }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
