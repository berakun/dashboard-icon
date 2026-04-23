<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/" class="flex items-center gap-3">
                <div class="bg-black p-2 rounded-xl flex items-center justify-center shadow-sm">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="white"
                        class="w-6 h-6"
                    >
                        <rect x="6" y="11" width="3" height="6" rx="1.5" />
                        <rect x="11" y="8" width="3" height="12" rx="1.5" />
                    </svg>
                </div>
                <span class="font-bold text-2xl text-gray-400 tracking-tight">blast</span>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-2xl"
        >
            <slot />
        </div>
    </div>
</template>
