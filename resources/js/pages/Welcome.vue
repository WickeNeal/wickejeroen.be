<template>
    <PublicLayout>
        <Hero />
        <Services />
        <Projects />
        <Contact />
    </PublicLayout>
</template>

<script setup lang="ts">
import Contact from '@/components/Contact.vue';
import Projects from '@/components/Projects.vue';
import Services from '@/components/Services.vue';
import Hero from '@/components/ui/Hero.vue';
import PublicLayout from '@/layouts/PublicLayout.vue';
</script>
