<script setup>
import { Link } from "@inertiajs/vue3";
import botika from "@/../assets/botika.svg";
import plane from "@/../assets/plane.svg";
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- 🔹 SIDEBAR -->
        <aside class="w-64 bg-white border-r flex flex-col justify-between">
            <!-- Top -->
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
                    <Link
                        :href="route('testing')"
                        class="group flex items-center px-4 py-3 rounded-xl font-extrabold transition-all relative"
                        :class="
                            route().current('testing')
                                ? 'bg-gray-100'
                                : 'hover:bg-gray-100'
                        "
                    >
                        <img :src="plane" class="w-6 h-6 mr-3" />

                        <span class="flex-1 text-sm font-extrabold"
                            >Testing</span
                        >

                        <div
                            v-if="route().current('testing')"
                            class="w-1 h-3 bg-black rounded-full absolute right-4"
                        ></div>
                    </Link>
                </nav>
            </div>

            <!-- 🔹 PROFILE -->
            <div class="pb-4">
                <div
                    class="bg-gray-50 rounded-xl p-3 shadow-sm border border-gray-300 rounded-lg mx-4"
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
                        <Link
                            :href="route('profile.edit')"
                            class="block text-xs hover:underline border-b border-gray-200 pb-2 font-semibold"
                        >
                            Edit Profile
                        </Link>

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

        <!-- 🔹 CONTENT -->
        <div class="flex-1">
            <!-- Header dari slot -->
            <header class="bg-white shadow px-6 py-4">
                <slot name="header" />
            </header>

            <!-- Isi halaman -->
            <main class="p-6 h-full bg-white">
                <slot />
            </main>
        </div>
    </div>
</template>
