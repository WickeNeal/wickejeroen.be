<template>
    <PublicLayout>
        <Hero />
        <Services />
        <Projects />
        <Contact />
    </PublicLayout>
</template>

<script setup lang="ts">
import PublicLayout from "@/layouts/PublicLayout.vue";
import Hero from "@/components/ui/Hero.vue";
import Services from "@/components/Services.vue";
import Projects from "@/components/Projects.vue";
import Contact from "@/components/Contact.vue";
</script>