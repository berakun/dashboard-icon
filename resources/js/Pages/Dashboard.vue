<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- 🔹 HEADER -->
        <template #header>
            <div class="flex justify-between items-center pt-12">
                <div>
                    <h2 class="text-base font-extrabold">Blast List</h2>
                    <p class="text-xs font-semibold text-gray-500">
                        Manage and monitor message blast delivery to multiple
                        recipients
                    </p>
                </div>

                <div class="flex gap-3">
                    <input
                        type="text"
                        placeholder="Search broadcast"
                        class="px-3 py-2 border rounded-lg text-sm"
                    />

                    <button
                        class="bg-black text-white px-4 py-2 rounded-lg text-sm"
                    >
                        + Create New Blast
                    </button>
                </div>
            </div>
        </template>

        <!-- 🔹 TABLE -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-800">
                    <tr>
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Agent ID</th>
                        <th class="p-3 text-left">Department ID</th>
                        <th class="p-3 text-left">Broadcast ID</th>
                        <th class="p-3 text-left">Template</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="i in 5" :key="i" class="border-t">
                        <td class="p-3">{{ i }}</td>
                        <td class="p-3">Example{{ i }}</td>
                        <td class="p-3">12345</td>
                        <td class="p-3">12345</td>
                        <td class="p-3">54321</td>
                        <td class="p-3">xxxxxxxx</td>
                        <td class="p-3">Template ex {{ i }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
