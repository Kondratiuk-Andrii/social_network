<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import GuestLayout from '@/Layouts/_GuestLayout.vue';

    defineProps({
        canResetPassword: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };
</script>

<template>
    <Head title="Log in" />
    <MainLayout>
        <div class="mb-4 text-sm font-medium text-green-600" v-if="status">
            {{ status }}
        </div>

        <form
            class="mx-auto mb-4 max-w-md rounded bg-white px-8 pb-8 pt-6 shadow-md"
            @submit.prevent="submit"
        >
            <div class="mb-4">
                <label class="mb-2 block text-sm font-bold text-gray-700" for="email">Email</label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mb-6">
                <label class="mb-2 block text-sm font-bold text-gray-700" for="password">
                    Password
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input
                        class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                        v-model="form.remember"
                        type="checkbox"
                    />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <a
                    class="inline-block align-baseline text-sm text-gray-600 hover:text-gray-900"
                    v-if="canResetPassword"
                    :href="route('password.request')"
                >
                    Forgot your password?
                </a>
                <PrimaryButton
                    class="focus:shadow-outline rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700 focus:outline-none"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log In
                </PrimaryButton>
            </div>
        </form>
    </MainLayout>
</template>
