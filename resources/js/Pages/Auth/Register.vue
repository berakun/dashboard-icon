<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    agent: "",
    department: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="space-y-4">
            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="name" value="Name" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="name"
                    type="text"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="email" value="Email" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="email"
                    type="email"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="agent" value="Agent" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="agent"
                    type="text"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.agent"
                    required
                    autocomplete="agent"
                />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="department" value="Department" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="department"
                    type="text"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.department"
                    required
                    autocomplete="department"
                />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="password" value="Password" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="password"
                    type="password"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                    class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
