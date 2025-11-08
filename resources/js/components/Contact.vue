<template>
    <section class="py-20 px-6 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark" id="contact">
        <div class="mx-auto max-w-6xl">
            <h2 class="text-center font-display text-4xl font-bold uppercase tracking-wider text-text-light dark:text-primary md:text-5xl">Contacteer ons vrijblijvend</h2>
            <div class="mt-12 flex flex-col gap-12 lg:flex-row">
                <div class="w-full lg:w-1/2">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="sr-only" for="name">Naam</label>
                            <input v-model="form.name" class="w-full rounded-lg border-text-dark/70 bg-[#242423] px-4 py-3 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:bg-[#242423] dark:text-text-dark dark:placeholder-text-dark/70" id="name" name="name" placeholder="Naam" type="text"/>
                            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="email">Email</label>
                            <input v-model="form.email" class="w-full rounded-lg border-text-dark/70 bg-[#242423] px-4 py-3 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:bg-[#242423] dark:text-text-dark dark:placeholder-text-dark/70" id="email" name="email" placeholder="Email" type="email"/>
                            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="subject">Onderwerp</label>
                            <input v-model="form.subject" class="w-full rounded-lg border-text-dark/70 bg-[#242423] px-4 py-3 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:bg-[#242423] dark:text-text-dark dark:placeholder-text-dark/70" id="subject" name="subject" placeholder="Onderwerp" type="text"/>
                            <div v-if="form.errors.subject" class="text-red-500 text-sm mt-1">{{ form.errors.subject }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="message">Bericht</label>
                            <textarea v-model="form.message" class="w-full rounded-lg border-text-dark/70 bg-[#242423] px-4 py-3 text-text-dark placeholder-text-dark/70 focus:border-primary focus:ring-primary dark:border-text-dark/70 dark:bg-[#242423] dark:text-text-dark dark:placeholder-text-dark/70" id="message" name="message" placeholder="Bericht" rows="5"></textarea>
                            <div v-if="form.errors.message" class="text-red-500 text-sm mt-1">{{ form.errors.message }}</div>
                        </div>
                        <button :disabled="form.processing"  style="background-color: #d4b280" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 text-background-dark transition-colors hover:opacity-90 dark:bg-primary dark:text-background-dark dark:hover:opacity-90" type="submit">
                            <span class="font-display text-base text-black font-bold uppercase tracking-wider">Verzenden</span>
                        </button>
                    </form>
                </div>
                <div class="flex w-full flex-col justify-center gap-6 lg:w-1/2 lg:pl-12">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">location_on</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Adres</h3>
                            <p class="text-text-light/70 dark:text-text-dark/80">Koolmeeslaan 15, 8900 Ieper</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">mail</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Email</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">info@wickejeroen.be</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">phone</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Telefoon</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">-- -- -- -- -- --</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
})

const submit = () => {
    form.post(route('contact.send'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    })
}
</script>
