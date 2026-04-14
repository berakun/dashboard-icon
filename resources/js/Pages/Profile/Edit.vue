<script setup>
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
// import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";

defineProps({
    mustVerifyEmail: Boolean,
    status: String,
});
</script>

<template>
    <div class="space-y-6 p-4">
        <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
            class="max-w-xl"
            @close="$emit('close')"
        />

        <!-- <div class="border-t pt-6">
            <UpdatePasswordForm class="max-w-full" />
        </div>
        <
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <DeleteUserForm class="max-w-xl" />
        </div> -->
    </div>
</template>
