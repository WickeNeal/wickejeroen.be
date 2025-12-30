<template>
    <div class="min-h-screen bg-gray-900 font-sans text-white">
        <nav class="border-b border-gray-800 bg-gray-900 px-6 py-4 shadow">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold uppercase tracking-widest text-[#B5A58D]">FLEXICRETE</h1>
                <div class="flex items-center gap-4">
                    <Link href="/admin/dashboard" class="text-sm text-gray-400 hover:text-white">Dashboard</Link>
                    <span class="text-sm font-bold text-white">Messages</span>
                    <Link href="/admin/logout" method="post" as="button" class="text-sm text-red-400 hover:text-red-300 hover:underline">Logout</Link>
                </div>
            </div>
        </nav>

        <div class="container mx-auto p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Inbox</h2>
            </div>

            <div class="rounded-lg border border-gray-800 bg-gray-900 overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-800">
                    <thead class="bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 bg-gray-900">
                        <tr v-for="message in messages" :key="message.id" class="hover:bg-gray-800 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ new Date(message.created_at).toLocaleDateString() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ message.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                <a :href="'mailto:' + message.email" class="hover:text-white">{{ message.email }}</a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400 max-w-xs truncate">{{ message.subject }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="viewMessage(message)" class="text-[#B5A58D] hover:text-[#a3947e] mr-4">View</button>
                                <button @click="deleteMessage(message.id)" class="text-red-400 hover:text-red-300">Delete</button>
                            </td>
                        </tr>
                        <tr v-if="messages.length === 0">
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">No messages yet.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Message Detail Modal -->
        <div v-if="selectedMessage" class="fixed inset-0 bg-black/80 flex items-center justify-center p-4 z-50 backdrop-blur-sm" @click.self="selectedMessage = null">
            <div class="bg-gray-800 rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border border-gray-700">
                <div class="p-6 border-b border-gray-700 flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ selectedMessage.subject }}</h2>
                        <div class="text-sm text-gray-400 mt-1">
                            From: <span class="text-white font-medium">{{ selectedMessage.name }}</span> ({{ selectedMessage.email }})
                            <br>
                            Date: {{ new Date(selectedMessage.created_at).toLocaleString() }}
                        </div>
                    </div>
                    <button @click="selectedMessage = null" class="text-gray-400 hover:text-white text-2xl leading-none">&times;</button>
                </div>
                <div class="p-6 text-gray-300 whitespace-pre-wrap leading-relaxed">
                    {{ selectedMessage.message }}
                </div>
                <div class="p-6 bg-gray-900 border-t border-gray-800 flex justify-end">
                    <a :href="'mailto:' + selectedMessage.email" class="bg-[#B5A58D] text-gray-900 font-bold px-4 py-2 rounded hover:bg-[#a3947e] mr-2">Reply</a>
                    <button @click="selectedMessage = null" class="bg-transparent border border-gray-600 text-gray-300 px-4 py-2 rounded hover:bg-gray-800 hover:text-white">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
    messages: Array<any>
}>();

const selectedMessage = ref<any>(null);

const viewMessage = (message: any) => {
    selectedMessage.value = message;
};

const deleteMessage = (id: number) => {
    if (confirm('Weet je zeker dat je dit bericht wilt verwijderen?')) {
        router.delete(`/admin/messages/${id}`);
    }
};
</script>
