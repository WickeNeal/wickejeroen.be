<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post('/admin/login', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Admin Login" />

    <div class="flex min-h-screen items-center justify-center bg-gray-900 text-white">
        <div class="w-full max-w-md rounded-lg bg-gray-800 p-8 shadow-lg">
            <h1 class="mb-6 text-center text-2xl font-bold">Admin Login</h1>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        required
                        autofocus
                        class="mt-1 block w-full rounded border-gray-700 bg-gray-900 px-3 py-2 text-white focus:border-indigo-500 focus:ring-indigo-500"
                    />
                    <div v-if="form.errors.email" class="mt-1 text-sm text-red-500">{{ form.errors.email }}</div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-400">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        required
                        class="mt-1 block w-full rounded border-gray-700 bg-gray-900 px-3 py-2 text-white focus:border-indigo-500 focus:ring-indigo-500"
                    />
                    <div v-if="form.errors.password" class="mt-1 text-sm text-red-500">{{ form.errors.password }}</div>
                </div>

                <div class="pt-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="flex w-full justify-center rounded bg-indigo-600 px-4 py-2 font-bold text-white hover:bg-indigo-500 disabled:opacity-50"
                    >
                        Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
