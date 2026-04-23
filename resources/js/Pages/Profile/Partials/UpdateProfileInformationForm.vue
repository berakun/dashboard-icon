<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
// import Modal from "@/Components/Modal.vue";
// import UpdatePasswordForm from "./UpdatePasswordForm.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    agent: user.agent,
    department: user.department,
});

// MODAL POPUP
const emit = defineEmits(["close", "open-password"]);

const submit = () => {
    form.patch(route("profile.update"), {
        preserveScroll: true,
        onSuccess: () => {
            // 2. Kirim sinyal tutup daripada membiarkan Inertia redirect
            emit("close");
            alert("Profile Updated Successfully");
        },
    });
};

const handleOpenPasswordModal = () => {
    emit("open-password"); // Memberitahu Layout untuk buka modal password
    emit("close"); // Memberitahu Layout untuk tutup modal profil ini
};
</script>

<template>
    <div class="p-1">
        <section>
            <form @submit.prevent="submit" class="pl-4 w-full space-y-4">
                <div
                    class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all"
                >
                    <InputLabel
                        for="name"
                        value="Name"
                        class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                    />
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

                <div
                    class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all"
                >
                    <InputLabel
                        for="email"
                        value="Email"
                        class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                    />
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

                <div
                    class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all"
                >
                    <InputLabel
                        for="agent"
                        value="Agent"
                        class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                    />
                    <TextInput
                        id="agent"
                        type="text"
                        class="mt-1 block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                        v-model="form.agent"
                        required
                        autocomplete="agent"
                    />
                    <InputError class="mt-2" :message="form.errors.agent" />
                </div>

                <div
                    class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all"
                >
                    <InputLabel
                        for="department"
                        value="Department"
                        class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                    />
                    <TextInput
                        id="department"
                        type="text"
                        class="mt-1 block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                        v-model="form.department"
                        required
                        autocomplete="department"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.department"
                    />
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900"
                        >
                            Click here to re-send.
                        </Link>
                    </p>
                    <div
                        v-show="status === 'verification-link-sent'"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent.
                    </div>
                </div>

                <div class="flex justify-between items-center gap-4">
                    <PrimaryButton
                        type="button"
                        @click="handleOpenPasswordModal"
                        class="bg-gray-600 hover:bg-gray-700"
                    >
                        Reset Password
                    </PrimaryButton>

                    <PrimaryButton :disabled="form.processing"
                        >Save</PrimaryButton
                    >
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p
                            v-if="form.recentlySuccessful"
                            class="text-sm text-gray-600"
                        >
                            Saved.
                        </p>
                    </Transition>
                </div>
            </form>
        </section>
    </div>
</template>
