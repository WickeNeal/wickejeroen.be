<template>
    <section class="bg-background-light dark:bg-background-dark" id="diensten">
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
