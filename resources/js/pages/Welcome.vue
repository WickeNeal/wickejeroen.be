<template>
    <PublicLayout>
        <Hero />
        <Services />
        <Projects :projects="projects" />
        <Contact />
    </PublicLayout>
</template>

<script setup lang="ts">
import PublicLayout from "@/layouts/PublicLayout.vue";
import Hero from "@/components/ui/Hero.vue";
import Services from "@/components/Services.vue";
import Projects from "@/components/Projects.vue";
import Contact from "@/components/Contact.vue";

defineProps<{
    projects: Array<any>;
}>();
</script>