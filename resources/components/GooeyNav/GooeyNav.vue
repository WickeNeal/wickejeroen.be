<template>
    <div>
        <div class="relative" ref="containerRef">
            <nav class="relative flex" :style="{ transform: 'translate3d(0,0,0.01px)' }">
                <ul
                    ref="navRef"
                    class="relative z-[3] m-0 flex list-none gap-8 p-0 px-4"
                    :style="{
                        color: 'white',
                        textShadow: '0 1px 1px hsl(205deg 30% 10% / 0.2)',
                    }"
                >
                    <li
                        v-for="(item, index) in items"
                        :key="index"
                        :class="[
                            'ease relative cursor-pointer rounded-full text-white shadow-[0_0_0.5px_1.5px_transparent] transition-[background-color_color_box-shadow] duration-300',
                            { active: props.activeIndex === index },
                        ]"
                    >
                        <a
                            :href="item.href || undefined"
                            @click="(e) => handleClick(e, index)"
                            @keydown="(e) => handleKeyDown(e, index)"
                            class="inline-block px-[1em] py-[0.6em] outline-none text-black font-semibold"
                        >
                            {{ item.label }}
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Removed effect spans to prevent double text glitch -->
        </div>
    </div>
</template>

<script setup lang="ts">
import { useTemplateRef } from 'vue';

interface GooeyNavItem {
    label: string;
    href: string | null;
}

interface GooeyNavProps {
    items: GooeyNavItem[];
    animationTime?: number;
    particleCount?: number;
    particleDistances?: [number, number];
    particleR?: number;
    timeVariance?: number;
    colors?: number[];
    activeIndex?: number; // Changed from initialActiveIndex
}

const props = withDefaults(defineProps<GooeyNavProps>(), {
    animationTime: 600,
    particleCount: 15,
    particleDistances: () => [90, 10],
    particleR: 100,
    timeVariance: 300,
    colors: () => [1, 2, 3, 1, 2, 3, 1, 4],
    activeIndex: 0, // Changed from initialActiveIndex
});

const containerRef = useTemplateRef<HTMLDivElement>('containerRef');
const navRef = useTemplateRef<HTMLUListElement>('navRef');


const handleClick = (e: Event, index: number) => {
  e.preventDefault(); // Prevent default link behavior

  // Get the target href from the item
  const targetHref = props.items[index].href;
  if (targetHref && targetHref.startsWith('#')) {
    const targetElement = document.querySelector(targetHref);
    if (targetElement) {
        targetElement.scrollIntoView({ behavior: 'smooth' });
    }
  } else if (targetHref) {
    // If it's not a hash link, just navigate normally
    window.location.href = targetHref;
  }
};

const handleKeyDown = (e: KeyboardEvent, index: number) => {
  if (e.key === 'Enter' || e.key === ' ') {
    e.preventDefault();
    const liEl = (e.currentTarget as HTMLElement).parentElement;
    if (liEl) {
      handleClick(
        {
          currentTarget: liEl
        } as unknown as Event,
        index
      );
    }
  }
};

</script>

<style scoped>
:root {
    --linear-ease: linear(
        0,
        0.068,
        0.19 2.7%,
        0.804 8.1%,
        1.037,
        1.199 13.2%,
        1.245,
        1.27 15.8%,
        1.274,
        1.272 17.4%,
        1.249 19.1%,
        0.996 28%,
        0.949,
        0.928 33.3%,
        0.926,
        0.933 36.8%,
        1.001 45.6%,
        1.013,
        1.019 50.8%,
        1.018 54.4%,
        1 63.1%,
        0.995 68%,
        1.001 85%,
        1
    );
}

.effect {
    position: absolute;
    opacity: 1;
    pointer-events: none;
    display: grid;
    place-items: center;
    z-index: 1;
}

.effect.text {
    color: white;
    transition: color 0.3s ease;
}

.effect.text.active {
    color: black;
}


.effect.filter::after {
    content: '';
    position: absolute;
    inset: 0;
    background: white;
    transform: scale(0);
    opacity: 0;
    z-index: -1;
    border-radius: 9999px;
}

.effect.active::after {
    animation: pill 0.3s ease both;
}

@keyframes pill {
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.particle,
.point {
    display: block;
    opacity: 0;
    width: 20px;
    height: 20px;
    border-radius: 9999px;
    transform-origin: center;
}

.particle {
    --time: 5s;
    position: absolute;
    top: calc(50% - 8px);
    left: calc(50% - 8px);
    animation: particle calc(var(--time)) ease 1 -350ms;
}

.point {
    background: var(--color);
    opacity: 1;
    animation: point calc(var(--time)) ease 1 -350ms;
}

@keyframes particle {
    0% {
        transform: rotate(0deg) translate(calc(var(--start-x)), calc(var(--start-y)));
        opacity: 1;
        animation-timing-function: cubic-bezier(0.55, 0, 1, 0.45);
    }
    70% {
        transform: rotate(calc(var(--rotate) * 0.5)) translate(calc(var(--end-x) * 1.2), calc(var(--end-y) * 1.2));
        opacity: 1;
        animation-timing-function: ease;
    }
    85% {
        transform: rotate(calc(var(--rotate) * 0.66)) translate(calc(var(--end-x)), calc(var(--end-y)));
        opacity: 1;
    }
    100% {
        transform: rotate(calc(var(--rotate) * 1.2)) translate(calc(var(--end-x) * 0.5), calc(var(--end-y) * 0.5));
        opacity: 1;
    }
}

@keyframes point {
    0% {
        transform: scale(0);
        opacity: 0;
        animation-timing-function: cubic-bezier(0.55, 0, 1, 0.45);
    }
    25% {
        transform: scale(calc(var(--scale) * 0.25));
    }
    38% {
        opacity: 1;
    }
    65% {
        transform: scale(var(--scale));
        opacity: 1;
        animation-timing-function: ease;
    }
    85% {
        transform: scale(var(--scale));
        opacity: 1;
    }
    100% {
        transform: scale(0);
        opacity: 0;
    }
}

li {
    background: white;
    color: black;
    border-radius: 9999px;
    transition: all 0.3s ease;
    text-shadow: none; /* Ensure no white shadow on black text */
    overflow: hidden; /* For potential ripple/gooey containment */
    z-index: 10;
}

li:hover {
    transform: scale(1.1);
}

li.active {
    border-radius: 8px; /* "Less" border radius */
    color: black;
}

/* Remove old pseudo-elements used for the 'single active blob' effect if we want all to be buttons */
li::after {
    display: none;
}
</style>
