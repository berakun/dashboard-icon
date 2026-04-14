<script setup>
import { Link } from "@inertiajs/vue3";
import botika from "@/../assets/botika.svg";
import plane from "@/../assets/plane.svg";
import { ref } from "vue";
import EditProfile from "@/Pages/Profile/Edit.vue";

const isModalOpen = ref(false);

const props = defineProps({
    blastings: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <aside class="w-64 bg-white border-r flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 px-6 py-4">
                    <div
                        class="bg-black p-2 rounded-xl flex items-center justify-center shadow-sm"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="white"
                            class="w-5 h-5"
                        >
                            <rect x="6" y="11" width="3" height="6" rx="1.5" />
                            <rect x="11" y="8" width="3" height="12" rx="1.5" />
                        </svg>
                    </div>
                    <span class="font-bold text-lg text-gray-400 tracking-tight"
                        >blast</span
                    >
                </div>

                <nav class="px-3 space-y-1">
                    <Link
                        :href="route('dashboard')"
                        class="group flex items-center px-4 py-3 rounded-xl font-extrabold transition-all relative"
                        :class="
                            route().current('dashboard')
                                ? 'bg-gray-100'
                                : 'hover:bg-gray-100'
                        "
                    >
                        <img :src="plane" class="w-6 h-6 mr-3" />
                        <span class="flex-1 text-sm font-extrabold">Blast</span>
                        <div
                            v-if="route().current('dashboard')"
                            class="w-1 h-3 bg-black rounded-full absolute right-4"
                        ></div>
                    </Link>
                </nav>
            </div>

            <div class="pb-4">
                <div
                    class="bg-gray-100 p-3 shadow-sm border border-gray-300 rounded-xl mx-4"
                >
                    <div
                        class="flex items-center gap-3 border-b border-gray-200 pb-3"
                    >
                        <div class="rounded-full overflow-hidden">
                            <img :src="botika" class="w-8 h-8 rounded-full" />
                        </div>
                        <div>
                            <div class="text-sm text-blue-950 font-bold">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-xs text-blue-950 font-bold">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <button
                            type="button"
                            @click="isModalOpen = true"
                            class="block text-left w-full text-xs hover:underline border-b border-gray-200 pb-2 font-semibold text-blue-950"
                        >
                            Edit Profile
                        </button>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="block text-xs text-blue-950 hover:underline font-semibold"
                        >
                            Logout
                        </Link>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 bg-white">
            <header class="bg-white pl-6 pr-6">
                <slot name="header" />
            </header>
            <main class="bg-white pl-6 pr-6">
                <slot />
            </main>
        </div>
    </div>

    <div
        v-if="isModalOpen"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    >
        <div
            class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
            @click="isModalOpen = false"
        ></div>

        <div
            class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[85vh] overflow-hidden z-10 flex flex-col"
        >
            <div
                class="flex justify-between items-center px-6 py-4 border-b bg-gray-50"
            >
                <h3 class="text-sm font-extrabold text-gray-800">
                    Edit Profile Information
                </h3>
                <button
                    @click="isModalOpen = false"
                    class="text-gray-400 hover:text-black text-2xl leading-none"
                >
                    &times;
                </button>
            </div>

            <EditProfile
                :must-verify-email="$page.props.mustVerifyEmail ?? false"
                :status="$page.props.status ?? ''"
                @close="isModalOpen = false"
            />
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}
</style>
