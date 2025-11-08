<template>
    <section class="py-20 px-6 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark" id="diensten">
        <div class="mx-auto max-w-6xl bg-background-light dark:bg-background-dark">
            <h2 class="text-center font-display text-4xl font-bold uppercase tracking-wider text-text-light dark:text-primary md:text-5xl mb-8">Our Services</h2>
            <div class="">
                <ScrollStack class="h-screen">
                    <ScrollStackItem item-class-name="bg-background-light dark:bg-background-dark">
                        <div class="flex flex-col items-center gap-4 text-center">
                            <span class="material-symbols-outlined text-5xl text-primary">construction</span>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide text-text-light dark:text-text-dark">Renovations</h3>
                            <p class="text-sm text-text-light/80 dark:text-text-dark/80">Transforming existing spaces with modern updates and high-quality finishes.</p>
                        </div>
                    </ScrollStackItem>
                    <ScrollStackItem item-class-name="bg-background-light dark:bg-background-dark">
                        <div class="flex flex-col items-center gap-4 text-center">
                            <span class="material-symbols-outlined text-5xl text-primary">foundation</span>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide text-text-light dark:text-text-dark">New Construction</h3>
                            <p class="text-sm text-text-light/80 dark:text-text-dark/80">Building your dream home from the ground up with expert planning and execution.</p>
                        </div>
                    </ScrollStackItem>
                    <ScrollStackItem item-class-name="bg-background-light dark:bg-background-dark">
                        <div class="flex flex-col items-center gap-4 text-center">
                            <span class="material-symbols-outlined text-5xl text-primary">carpenter</span>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide text-text-light dark:text-text-dark">Custom Woodwork</h3>
                            <p class="text-sm text-text-light/80 dark:text-text-dark/80">Crafting unique, tailor-made wooden elements that add character to any space.</p>
                        </div>
                    </ScrollStackItem>
                    <ScrollStackItem item-class-name="bg-background-light dark:bg-background-dark">
                        <div class="flex flex-col items-center gap-4 text-center">
                            <span class="material-symbols-outlined text-5xl text-primary">real_estate_agent</span>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide text-text-light dark:text-text-dark">Consulting</h3>
                            <p class="text-sm text-text-light/80 dark:text-text-dark/80">Providing professional advice and project management for your construction needs.</p>
                        </div>
                    </ScrollStackItem>
                </ScrollStack>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import ScrollStack, { ScrollStackItem } from "../../components/ScrollStack/ScrollStack.vue";
</script>