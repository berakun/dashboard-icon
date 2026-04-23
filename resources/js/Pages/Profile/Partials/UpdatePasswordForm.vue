<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const emit = defineEmits(["close"]);

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit("close"); // Tambahkan ini agar modal otomatis tertutup setelah sukses
        },
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay
                secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-4">
            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="current_password" value="Current Password" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="mt-2"
                />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel for="password" value="New Password" class="text-[10px] uppercase tracking-wider font-extrabold mb-0" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="relative bg-gray-50 border-2 border-transparent focus-within:border-purple-500 focus-within:bg-white rounded-2xl px-4 py-2 transition-all">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                    class="text-[10px] uppercase tracking-wider font-extrabold mb-0"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="block w-full border-none bg-transparent p-0 text-sm shadow-none !focus:ring-0 !focus:border-transparent outline-none"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

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
</template>
