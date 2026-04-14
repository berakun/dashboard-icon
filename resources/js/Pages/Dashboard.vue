<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import whitePlane from "@/../assets/whitePlane.svg";

const props = defineProps({
    blastings: {
        type: Array,
        default: () => [],
    },
});

// State untuk halaman aktif
const currentPage = ref(1);
const itemsPerPage = 5;

// Logika menghitung data yang ditampilkan (Pagination)
const paginatedData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return props.blastings.slice(start, end);
});

// Menghitung total halaman
const totalPages = computed(() =>
    Math.ceil(props.blastings.length / itemsPerPage),
);

// Fungsi untuk pindah halaman
const setPage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
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
                        placeholder="Search"
                        class="px-3 py-2 border rounded-lg text-sm"
                    />
                    <button
                        class="bg-black text-white px-4 py-2 rounded-lg text-sm justify-content center flex items-center gap-2"
                    >
                        <img :src="whitePlane" class="w-4 h-4" />

                        <span>Create New Blast</span>
                    </button>
                </div>
            </div>
        </template>

        <div class="bg-white overflow-hidden mt-6">
            <table class="w-full text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-4 text-left font-bold">No</th>
                        <th class="p-4 text-left font-bold">Name</th>
                        <th class="p-4 text-left font-bold">ID</th>
                        <th class="p-4 text-left font-bold">Agent ID</th>
                        <th class="p-4 text-left font-bold">Department ID</th>
                        <th class="p-4 text-left font-bold">Broadcast ID</th>
                        <th class="p-4 text-left font-bold">Template</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="(item, index) in paginatedData"
                        :key="item.id"
                        class="border-t hover:bg-gray-50"
                    >
                        <td class="p-4 text-gray-500 font-medium">
                            {{ (currentPage - 1) * itemsPerPage + index + 1 }}.
                        </td>
                        <td class="p-4 font-semibold">{{ item.name }}</td>
                        <td class="p-4 font-semibold">{{ item.id }}</td>
                        <td class="p-4 font-semibold">{{ item.agent_id }}</td>
                        <td class="p-4 font-semibold">
                            {{ item.department_id }}
                        </td>
                        <td class="p-4 font-semibold">
                            {{ item.broadcast_id }}
                        </td>
                        <td class="p-4 font-semibold">
                            {{ item.template_name }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                class="flex justify-between items-center px-6 py-4 border-t bg-white"
            >
                <div class="text-xs font-bold text-gray-500">
                    Showing
                    <span class="border rounded px-2 py-1 mx-1">5</span> items
                    per page
                </div>

                <div class="flex items-center gap-2">
                    <button
                        @click="setPage(currentPage - 1)"
                        :disabled="currentPage === 1"
                        class="text-xs font-bold px-3 py-1 text-gray-500 disabled:opacity-30"
                    >
                        Previous
                    </button>

                    <div class="flex gap-1">
                        <button
                            v-for="page in totalPages"
                            :key="page"
                            @click="setPage(page)"
                            class="w-8 h-8 flex items-center justify-center rounded-full text-xs font-bold transition-all"
                            :class="
                                currentPage === page
                                    ? 'bg-gray-200 text-black'
                                    : 'text-gray-400 hover:bg-gray-100'
                            "
                        >
                            {{ page }}
                        </button>
                    </div>

                    <button
                        @click="setPage(currentPage + 1)"
                        :disabled="currentPage === totalPages"
                        class="text-xs font-bold px-3 py-1 text-gray-500 disabled:opacity-30"
                    >
                        Next
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
