<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
// We'll create this Navbar in the next step.
// The path assumes you'll create it inside `resources/js/components/ui/`
import Navbar from '@/components/ui/Navbar.vue'
import { useDark } from '@vueuse/core'

// This finds the <html> tag and forces class="dark"
// This activates the .dark block we just added to app.css
useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark',
    valueLight: 'dark', // We are forcing dark mode
})
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
