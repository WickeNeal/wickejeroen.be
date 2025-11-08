<template>
    <section class="relative flex min-h-[calc(100vh-80px)] w-full flex-col lg:flex-row overflow-hidden">
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
        <div class="relative z-10 flex w-full flex-col items-start justify-center gap-6 p-6 text-left lg:w-1/2 lg:p-20">
            <h1 class="font-display text-5xl font-bold uppercase leading-tight tracking-wide text-text-light dark:text-text-dark md:text-6xl lg:text-7xl">
                Quality Craftsmanship, Lasting Results
            </h1>
            <p class="text-lg text-text-light/80 dark:text-text-dark/80">
                Welcome to Jeroen Wicke, where we bring your construction and renovation visions to life with precision and passion.
            </p>
            <button class="mt-4 flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 bg-text-light text-background-light transition-all hover:opacity-90 dark:bg-primary dark:text-background-dark dark:hover:opacity-90">
                <span class="font-display text-base font-bold uppercase tracking-wider">View Our Work</span>
            </button>
        </div>
        <div class="relative z-10 h-96 w-full lg:h-auto lg:w-1/2">
            <div class="absolute inset-0 h-full w-full bg-cover bg-center bg-no-repeat" data-alt="A modern kitchen with clean lines and high-end appliances, a showcase of quality renovation work." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDMBmRkHTNrtEu4TJbYQoBjgeWOv0hkAx_uR_cS87kLj8JlTSZfwF3jatf6ZW-MuwujV3V8CPFrESXdRABfIozyeB1KbWG1MnllXuIOg8UaEnPxNRSp3NCJWV--z4frhnGcNeNxRNFqmCUNnRWnmN3LwYATe2I83yuWXk1ntEGDZMqb1ORiN4DdY4TLo94JS1NbYUzRUy8uPVvprG5bIHwuaRRrtD2cahmR7r45tmfK8pJFuVAjD7j4YtNZRMtxUktpcQRbLzt5uX72");'></div>
            <div class="absolute inset-0 bg-background-dark/20 dark:bg-background-dark/40"></div>
        </div>
    </section>
</template>
<script setup lang="ts">
import DotGrid from "../../../backgrounds/DotGrid/DotGrid.vue";

// Define colors based on the current theme (forced dark for now)
const dotGridBaseColor = '#333333'; // A subtle dark gray, contrasting with background-dark
const dotGridActiveColor = '#d4b280'; // primary
</script>
