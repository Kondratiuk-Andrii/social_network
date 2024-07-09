<script setup lang="ts">
    import { useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { watchEffect } from 'vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { IErrors, IForm } from '@/Pages/Personal/types';

    const props = defineProps<{
        errors: IErrors;
        flash: {
            message?: string;
        };
    }>();

    const form = useForm<IForm>({
        title: '',
        content: '',
    });

    watchEffect(() => {
        if (props.flash.message) {
            Swal.fire({
                title: props.flash.message,
                icon: 'success',
                toast: true,
                timer: 2500,
                position: 'top',
                timerProgressBar: true,
                showConfirmButton: false,
            });
        }
    });
</script>

<template>
    <MainLayout>
        <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-md">
            <form
                class="space-y-6"
                @submit.prevent="
                    form.post(route('post.store'), {
                        onSuccess: () => form.reset('title', 'content'),
                    })
                "
            >
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                    <input
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        id="title"
                        v-model="form.title"
                        type="text"
                        placeholder="Title"
                    />
                    <div class="mt-2 text-sm text-red-600" v-if="props.errors.title">
                        {{ props.errors.title }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700" for="content">
                        Content
                    </label>
                    <textarea
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        id="content"
                        v-model="form.content"
                        placeholder="Content"
                    ></textarea>
                    <div class="mt-2 text-sm text-red-600" v-if="props.errors.content">
                        {{ props.errors.content }}
                    </div>
                </div>
                <div>
                    <button
                        class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        type="submit"
                    >
                        Publish
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<style scoped></style>
