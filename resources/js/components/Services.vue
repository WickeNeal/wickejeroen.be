<template>
    <section class="bg-background-light dark:bg-background-dark px-6 pt-20 md:px-10 lg:px-20" id="diensten">
        <div class="bg-background-light dark:bg-background-dark mx-auto max-w-6xl">
            <h2 class="font-display text-text-light dark:text-primary mb-8 text-center text-4xl font-bold tracking-wider uppercase md:text-5xl">
                Onze diensten
            </h2>
        </div>
        <div class="h-screen w-full">
            <FlowingMenu :items="menuItems" />
        </div>
    </section>
</template>

<script setup lang="ts">
import FlowingMenu from '../../components/FlowingMenu/FlowingMenu.vue';

const menuItems = [
    {
        link: '#',
        text: 'Totaalrenovaties',
        image: './images/flow-menu/totaalrenovaties.jpg',
        icon: 'construction',
        description: 'Van badkamers tot volledige woningen, wij zorgen voor een complete make-over.',
    },
    {
        link: '#',
        text: 'Algemene Aannemingen\n',
        image: './images/flow-menu/algemene_aannemingen.jpg',
        icon: 'foundation',
        description: 'Nieuwbouw, uitbreidingen en meer – wij nemen uw project van A tot Z in handen.',
    },
    {
        link: '#',
        text: 'Kleine Werken',
        image: './images/flow-menu/kleine_werken.jpg',
        icon: 'carpenter',
        description: 'Ook voor kleinere klussen zoals herstellingen of aanpassingen kunt u op ons rekenen.',
    },
];
</script>
