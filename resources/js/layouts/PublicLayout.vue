<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/components/ui/Navbar.vue'; // We'll create this next
import { useDark } from '@vueuse/core';

// This finds the <html> tag and adds class="dark"
// to permanently enable our dark theme.
useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark',
    valueLight: 'dark', // We force dark mode, no light theme
});
</script>

<template>
    <Head title="Jeroen Wicke - Bouw & Renovatiewerken" />

    <div class="min-h-screen bg-background text-foreground">
        
        <Navbar />

        <main>
            <slot />
        </main>

        </div>
</template>