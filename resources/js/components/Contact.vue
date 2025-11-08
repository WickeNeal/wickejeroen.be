<template>
    <section class="py-20 px-6 md:px-10 lg:px-20 bg-background-light dark:bg-background-dark" id="contact">
        <div class="mx-auto max-w-6xl">
            <h2 class="text-center font-display text-4xl font-bold uppercase tracking-wider text-text-light dark:text-primary md:text-5xl">Let's Build Together</h2>
            <div v-if="$page?.props?.flash?.success" class="mt-8 text-center text-lg text-green-500">
                {{ $page.props.flash.success }}
            </div>
            <div class="mt-12 flex flex-col gap-12 lg:flex-row">
                <div class="w-full lg:w-1/2">
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label class="sr-only" for="name">Name</label>
                            <input v-model="form.name" class="w-full rounded-lg border-text-light/20 bg-background-dark/5 px-4 py-3 text-text-light placeholder-text-light/50 focus:border-primary focus:ring-primary dark:border-text-dark/20 dark:bg-text-dark/5 dark:text-text-dark dark:placeholder-text-dark/50" id="name" name="name" placeholder="Name" type="text"/>
                            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="email">Email</label>
                            <input v-model="form.email" class="w-full rounded-lg border-text-light/20 bg-background-dark/5 px-4 py-3 text-text-light placeholder-text-light/50 focus:border-primary focus:ring-primary dark:border-text-dark/20 dark:bg-text-dark/5 dark:text-text-dark dark:placeholder-text-dark/50" id="email" name="email" placeholder="Email" type="email"/>
                            <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="subject">Subject</label>
                            <input v-model="form.subject" class="w-full rounded-lg border-text-light/20 bg-background-dark/5 px-4 py-3 text-text-light placeholder-text-light/50 focus:border-primary focus:ring-primary dark:border-text-dark/20 dark:bg-text-dark/5 dark:text-text-dark dark:placeholder-text-dark/50" id="subject" name="subject" placeholder="Subject" type="text"/>
                            <div v-if="form.errors.subject" class="text-red-500 text-sm mt-1">{{ form.errors.subject }}</div>
                        </div>
                        <div>
                            <label class="sr-only" for="message">Message</label>
                            <textarea v-model="form.message" class="w-full rounded-lg border-text-light/20 bg-background-dark/5 px-4 py-3 text-text-light placeholder-text-light/50 focus:border-primary focus:ring-primary dark:border-text-dark/20 dark:bg-text-dark/5 dark:text-text-dark dark:placeholder-text-dark/50" id="message" name="message" placeholder="Message" rows="5"></textarea>
                            <div v-if="form.errors.message" class="text-red-500 text-sm mt-1">{{ form.errors.message }}</div>
                        </div>
                        <button :disabled="form.processing" class="flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-8 bg-text-light text-background-light transition-colors hover:opacity-90 dark:bg-primary dark:text-background-dark dark:hover:opacity-90" type="submit">
                            <span class="font-display text-base font-bold uppercase tracking-wider">Send Message</span>
                        </button>
                    </form>
                </div>
                <div class="flex w-full flex-col justify-center gap-6 lg:w-1/2 lg:pl-12">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">location_on</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Address</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">123 Construction Ave, Buildtown, BT 45678</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">mail</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Email</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">contact@jeroenwicke.com</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined mt-1 text-2xl text-primary">phone</span>
                        <div>
                            <h3 class="font-display text-xl font-bold uppercase tracking-wide">Phone</h3>
                            <p class="text-text-light/80 dark:text-text-dark/80">(123) 456-7890</p>
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
