<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <div class="p-6">
                <h1 class="text-2xl font-bold">Halaman Testing</h1>
                <p>Berhasil dimuat!</p>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
