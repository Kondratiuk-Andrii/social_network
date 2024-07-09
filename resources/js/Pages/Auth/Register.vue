<script setup lang="ts">
    import { Head, useForm } from '@inertiajs/vue3';
    import InputError from '@/Components/Shared/InputError.vue';
    import PrimaryButton from '@/Components/Shared/PrimaryButton.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('register'), {
            onFinish: () => {
                form.reset('password', 'password_confirmation');
            },
        });
    };
</script>

<template>
    <Head title="Register" />
    <main-layout>
        <form
            class="mx-auto mb-4 max-w-md rounded bg-white px-8 pb-8 pt-6 shadow-md"
            @submit.prevent="submit"
        >
            <div class="mb-4">
                <label class="mb-2 block text-sm font-bold text-gray-700" for="name">Name</label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mb-4">
                <label class="mb-2 block text-sm font-bold text-gray-700" for="email">Email</label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mb-4">
                <label class="mb-2 block text-sm font-bold text-gray-700" for="password">
                    Password
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mb-6">
                <label
                    class="mb-2 block text-sm font-bold text-gray-700"
                    for="password_confirmation"
                >
                    Confirm Password
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-between">
                <a
                    class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    :href="route('login')"
                >
                    Already registered?
                </a>
                <PrimaryButton
                    class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </main-layout>
</template>
