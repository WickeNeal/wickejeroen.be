<template>
    <section class="bg-background-light dark:bg-background-dark px-6 py-20 md:px-10 lg:px-20" id="contact">
        <div class="mx-auto max-w-6xl">
            <h2 class="font-display text-text-light dark:text-primary text-center text-4xl font-bold tracking-wider uppercase md:text-5xl">
                Contacteer ons vrijblijvend
            </h2>
            <div class="mt-12 flex flex-col gap-12 lg:flex-row">
                <div class="w-full lg:w-1/2">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="sr-only" for="name">Naam</label>
                            <input
                                v-model="form.name"
                                class="border-text-dark/70 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:text-text-dark dark:placeholder-text-dark/70 w-full rounded-lg bg-[#242423] px-4 py-3 dark:bg-[#242423]"
                                id="name"
                                name="name"
                                placeholder="Naam"
                                type="text"
                            />
                            <div v-if="form.errors.name" class="mt-1 text-sm text-red-500">{{ form.errors.name }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="email">Email</label>
                            <input
                                v-model="form.email"
                                class="border-text-dark/70 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:text-text-dark dark:placeholder-text-dark/70 w-full rounded-lg bg-[#242423] px-4 py-3 dark:bg-[#242423]"
                                id="email"
                                name="email"
                                placeholder="Email"
                                type="email"
                            />
                            <div v-if="form.errors.email" class="mt-1 text-sm text-red-500">{{ form.errors.email }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="subject">Onderwerp</label>
                            <input
                                v-model="form.subject"
                                class="border-text-dark/70 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:text-text-dark dark:placeholder-text-dark/70 w-full rounded-lg bg-[#242423] px-4 py-3 dark:bg-[#242423]"
                                id="subject"
                                name="subject"
                                placeholder="Onderwerp"
                                type="text"
                            />
                            <div v-if="form.errors.subject" class="mt-1 text-sm text-red-500">{{ form.errors.subject }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="message">Bericht</label>
                            <textarea
                                v-model="form.message"
                                class="border-text-dark/70 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:text-text-dark dark:placeholder-text-dark/70 w-full rounded-lg bg-[#242423] px-4 py-3 dark:bg-[#242423]"
                                id="message"
                                name="message"
                                placeholder="Bericht"
                                rows="5"
                            ></textarea>
                            <div v-if="form.errors.message" class="mt-1 text-sm text-red-500">{{ form.errors.message }}</div>
                        </div>
                        <button
                            :disabled="form.processing"
                            style="background-color: #d4b280"
                            class="text-background-dark dark:bg-primary dark:text-background-dark flex h-12 w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg px-8 transition-colors hover:opacity-90 dark:hover:opacity-90"
                            type="submit"
                        >
                            <span class="font-display text-base font-bold tracking-wider text-black uppercase">Verzenden</span>
                        </button>
                    </form>
                </div>
                <div class="flex w-full flex-col justify-center gap-6 lg:w-1/2 lg:pl-12">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1 text-2xl">location_on</span>
                        <div>
                            <h3 class="font-display text-xl font-bold tracking-wide uppercase">Adres</h3>
                            <p class="text-text-light/70 dark:text-text-dark/80">Koolmeeslaan 15, 8900 Ieper</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1 text-2xl">mail</span>
                        <div>
                            <h3 class="font-display text-xl font-bold tracking-wide uppercase">Email</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">info@wickejeroen.be</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-primary mt-1 text-2xl">phone</span>
                        <div>
                            <h3 class="font-display text-xl font-bold tracking-wide uppercase">Telefoon</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">-- -- -- -- -- --</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>
