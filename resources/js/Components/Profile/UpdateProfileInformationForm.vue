<script setup lang="ts">
    import { Link, useForm, usePage } from '@inertiajs/vue3';
    import InputError from '@/Components/Shared/InputError.vue';
    import InputLabel from '@/Components/Shared/InputLabel.vue';
    import PrimaryButton from '@/Components/Shared/PrimaryButton.vue';
    import TextInput from '@/Components/Shared/TextInput.vue';

    defineProps<{
        mustVerifyEmail?: Boolean;
        status?: String;
    }>();

    const user = usePage().props.auth.user;

    const form = useForm({
        name: user.name,
        email: user.email,
    });
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form class="mt-6 space-y-6" @submit.prevent="form.patch(route('profile.update'))">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    class="mt-1 block w-full"
                    id="name"
                    v-model="form.name"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    class="mt-1 block w-full"
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    Your email address is unverified.
                    <Link
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    class="mt-2 text-sm font-medium text-green-600"
                    v-show="status === 'verification-link-sent'"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p class="text-sm text-gray-600" v-if="form.recentlySuccessful">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
