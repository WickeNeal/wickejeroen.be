<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

// This path will now work because you just added the image
const logoUrl = '/images/logo-beige.png'
</script>

<template>
    <nav class="container mx-auto max-w-7xl px-6 py-8">
        <div class="flex items-center justify-between">
            <Link href="/">
                <img :src="logoUrl" alt="Jeroen Wicke Logo" class="h-10 w-auto" />
            </Link>

            <div class="hidden items-center space-x-8 md:flex">
                <a href="#diensten"
                   class="text-foreground/70 transition-colors hover:text-foreground">
                    Onze diensten
                </a>
                <a href="#fotos"
                   class="text-foreground/70 transition-colors hover:text-foreground">
                    Foto's
                </a>

                <a href="#contact"
                   class="rounded-md bg-primary px-4 py-2 text-primary-foreground transition-opacity hover:opacity-90">
                    Neem contact op
                </a>
            </div>

            <div class="md:hidden">
                <button class="text-foreground">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</template>
