<script setup lang="ts">
import { ref } from 'vue'

const navLinks = ref([
  { name: 'Home', href: '/' },
  { name: 'Diensten', href: '/diensten' },
  { name: 'Realisaties', href: '/realisaties' },
  { name: 'Contact', href: '/contact' },
])
</script>

<template>
  <nav class="bg-secondary p-4">
    <div class="container mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div>
        <a href="/">
          <img src="../../images/Wicke Jeroen logo/6.png" alt="Logo" class="h-10">
        </a>
      </div>

      <!-- Navigation Links -->
      <div class="hidden md:flex space-x-8">
        <a v-for="link in navLinks" :key="link.name" :href="link.href" class="text-foreground hover:text-primary transition-colors text-lg font-medium">
          {{ link.name }}
        </a>
      </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <!-- Hamburger Icon -->
            <button class="text-foreground">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>
  </nav>
</template>

<style scoped>
/* Scoped styles for the navbar can go here if needed */
</style>
