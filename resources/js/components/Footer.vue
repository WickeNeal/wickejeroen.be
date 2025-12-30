<template>
    <footer class="bg-background-dark/5 py-8 px-6 dark:bg-text-dark/5 md:px-10 lg:px-20">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-center gap-4 text-center">
            <div class="flex items-center gap-6">
                <div class="group relative">
                    <p class="text-sm text-text-light/70 dark:text-text-dark/70 cursor-pointer">
                        <span 
                            class="text-primary font-semibold underline decoration-primary/30 underline-offset-4 group-hover:decoration-primary transition-all"
                            @click="toggleEasterEgg"
                        >
                            Neal Wicke
                        </span> © 2025. All Rights Reserved.
                    </p>

                    <!-- Hover Card -->
                    <div 
                        class="absolute bottom-full right-0 mb-6 w-72 translate-y-4 opacity-0 invisible transition-all duration-300 ease-out z-50 group-hover:translate-y-0 group-hover:opacity-100 group-hover:visible"
                        :class="{'!opacity-100 !visible !translate-y-0': showEasterEgg}"
                    >
                        <div class="relative bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-5 border border-zinc-100 dark:border-zinc-800 ring-1 ring-black/5">
                             <!-- Arrow -->
                             <div class="absolute -bottom-2 right-12 h-4 w-4 rotate-45 bg-white dark:bg-zinc-900 border-b border-r border-zinc-100 dark:border-zinc-800"></div>
                             
                             <!-- Content -->
                             <div class="flex items-start gap-4 mb-4">
                                <div class="h-12 w-12 shrink-0 rounded-full bg-primary/10 flex items-center justify-center text-2xl animate-bounce-subtle">
                                    👋
                                </div>
                                <div class="text-left">
                                    <h4 class="font-bold text-gray-900 dark:text-white text-lg leading-tight">Neal Wicke</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Freelance Web Developer</p>
                                    <a href="tel:+32491649501" class="text-xs font-mono text-gray-400 hover:text-primary transition-colors flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">call</span>
                                        +32 491 64 95 01
                                    </a>
                                </div>
                             </div>
                             
                             <div class="flex gap-3">
                                <a 
                                    href="https://www.linkedin.com/in/neal-wicke-00a8a11b6/" 
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex-1 flex items-center justify-center gap-2 bg-[#0077b5] hover:bg-[#006396] text-white text-xs font-semibold py-2.5 px-3 rounded-xl transition-colors shadow-sm hover:shadow active:scale-[0.98]"
                                    aria-label="LinkedIn"
                                >
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </a>
                                <a 
                                    href="https://www.facebook.com/neal.wickee" 
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex-1 flex items-center justify-center gap-2 bg-[#1877F2] hover:bg-[#1565C0] text-white text-xs font-semibold py-2.5 px-3 rounded-xl transition-colors shadow-sm hover:shadow active:scale-[0.98]"
                                    aria-label="Facebook"
                                >
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.791-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    Facebook
                                </a>
                             </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </footer>
</template>
<script setup lang="ts">
import { ref } from 'vue';

const showEasterEgg = ref(false);

const toggleEasterEgg = () => {
    showEasterEgg.value = !showEasterEgg.value;
};
</script>