<script setup lang="ts"> // <-- FIX 1: Added lang="ts"
// FIX 2: Corrected the import path
import SplitText from '../../TextAnimations/SplitText/SplitText.vue';

// This path will be fixed in the next step
const heroBgUrl = '/images/hero-bg.jpg';
</script>

<template>
    <div
        class="relative flex min-h-[500px] items-center justify-center overflow-hidden px-6 py-24 md:min-h-[600px]"
    >
        <div
            class="absolute inset-0 z-0 bg-cover bg-center"
            :style="{ backgroundImage: `url(${heroBgUrl})` }"
        >
            <div class="absolute inset-0 z-10 bg-black/50 backdrop-brightness-75" />
        </div>

        <div class="relative z-20 max-w-2xl rounded-lg bg-card p-8 text-card-foreground shadow-2xl md:p-12">

            <SplitText
                class="mb-6"
                :from="{ opacity: 0, y: 30 }"
                :to="{ opacity: 1, y: 0 }"
                :delay="10"
                :duration="0.6"
            >
                <h1 class="text-4xl font-bold text-gray-900 md:text-5xl">
                    Wie We Zijn
                </h1>
            </SplitText>

            <p class="text-lg leading-relaxed text-gray-700">
                Met meer dan 15 jaar ervaring in de bouwsector staan we garant voor
                kwaliteit en betrouwbaarheid. Onze missie? Uw visie omzetten in realiteit,
                met oog voor detail en duurzaamheid.
            </p>
        </div>
    </div>
</template>
