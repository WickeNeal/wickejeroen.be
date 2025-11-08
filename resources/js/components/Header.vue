<template>
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap bg-background-light/80 px-6 py-4 shadow-md backdrop-blur-sm dark:bg-background-dark/80 md:px-10 lg:px-20">
        <div class="flex items-center gap-4">
            <div class="h-8 w-8 text-primary">
                <svg fill="currentColor" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_6_330)">
                        <path clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill-rule="evenodd"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_6_330">
                            <rect fill="white" height="48" width="48"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-bold uppercase tracking-wider text-text-light dark:text-text-dark">Jeroen Wicke</h2>
        </div>
        <nav class="hidden items-center gap-8 md:flex">
            <a class="text-sm font-bold uppercase tracking-wider text-text-light transition-colors hover:text-primary dark:text-text-dark dark:hover:text-primary" href="#">Home</a>
            <a class="text-sm font-bold uppercase tracking-wider text-text-light transition-colors hover:text-primary dark:text-text-dark dark:hover:text-primary" href="#diensten">Diensten</a>
            <a class="text-sm font-bold uppercase tracking-wider text-text-light transition-colors hover:text-primary dark:text-text-dark dark:hover:text-primary" href="#realisaties">Realisaties</a>
            <a class="text-sm font-bold uppercase tracking-wider text-text-light transition-colors hover:text-primary dark:text-text-dark dark:hover:text-primary" href="#contact">Contact</a>
        </nav>
        <button class="md:hidden text-text-light dark:text-text-dark">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
    </header>
</template>
<script setup lang="ts">
</script>