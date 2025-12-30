<template>
    <section id="home" class="relative flex min-h-screen w-full flex-col lg:flex-row overflow-hidden">
        <div class="absolute inset-0 z-0">
            <DotGrid
                :dot-size="5"
                :gap="15"
                :proximity="120"
                :speed-trigger="100"
                :shock-radius="250"
                :shock-strength="5"
                :max-speed="5000"
                :resistance="750"
                :return-duration="1.5"
                :base-color="dotGridBaseColor"
                :active-color="dotGridActiveColor"
            />
        </div>
        <div class="relative z-10 flex w-full flex-1 flex-col items-center justify-center gap-6 p-6 pt-32 text-center lg:p-20">
            <h1 class="font-display text-4xl font-bold uppercase leading-tight tracking-wide text-text-light dark:text-text-dark md:text-5xl lg:text-7xl">
                Specialist in Totaalrenovaties & Algemene Bouwwerken
            </h1>
            <p class="font-semibold text-lg text-text-light/80 dark:text-text-dark/80 max-w-2xl">
                Van ruwbouw tot verfijnde afwerking. Uw betrouwbare aannemer voor regio Ieper en heel West-Vlaanderen. Kwaliteit waar u op kunt bouwen.
            </p>
        </div>
    </section>
</template>
<script setup lang="ts">
import DotGrid from "../../../backgrounds/DotGrid/DotGrid.vue";

// Define colors based on the current theme (forced dark for n6 (1).pngow)
const dotGridBaseColor = '#333333'; // A subtle dark gray, contrasting with background-dark
const dotGridActiveColor = '#d4b280'; // primary
</script>
