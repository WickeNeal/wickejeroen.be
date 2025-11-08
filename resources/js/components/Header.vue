<template>
    <header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap bg-background-light/80 px-6 py-4 shadow-md backdrop-blur-sm dark:bg-background-dark/80 md:px-10 lg:px-20">
        <div class="flex items-center gap-4">
            <div class="text-primary">
                <div>
                    <a href="/">

                    </a>
                </div>
            </div>
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
