<template>
    <section class="bg-background-dark/5 pt-20 pb-20" id="realisaties">
        <div>
            <CircularGallery
                :items="circularGalleryItems"
                :bend="0"
                text-color="#ffffff"
                :border-radius="0.05"
                font="bold 30px Arial"
                :scroll-speed="2"
                :scroll-ease="0.05"
            />
        </div>
    </section>
</template>

<script setup lang="ts">
import CircularGallery from '../../components/CircularGallery/CircularGallery.vue';
import { computed } from 'vue';

const customImages = [
    "/wickejeroen.be/images/mooiste foto's/20170814_114439.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20190828_141341 1.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20191121_164606 1.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20200124_134219 1.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20200310_080808.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20200326_112935.jpg",
    "/wickejeroen.be/images/mooiste foto's/IMG_20210320_131124.jpg",
];

const circularGalleryItems = computed(() => {
    return customImages.map(url => ({ image: url, text: '' }));
});
</script>
