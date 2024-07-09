<script setup lang="ts">
    import { Head } from '@inertiajs/vue3';
    import DeleteUserForm from '@/Components/Profile/DeleteUserForm.vue';
    import UpdatePasswordForm from '@/Components/Profile/UpdatePasswordForm.vue';
    import UpdateProfileInformationForm from '@/Components/Profile/UpdateProfileInformationForm.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';

    defineProps<{
        mustVerifyEmail?: boolean;
        status?: string;
    }>();
</script>

<template>
    <Head title="Profile" />

    <main-layout>
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <UpdateProfileInformationForm
                    class="max-w-xl"
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                />
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </main-layout>
</template>
