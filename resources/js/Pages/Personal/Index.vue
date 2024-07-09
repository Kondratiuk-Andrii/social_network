<script setup lang="ts">
    import { Head, useForm } from '@inertiajs/vue3';
    import Swal from 'sweetalert2';
    import { ref, watchEffect } from 'vue';
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { IErrors, IForm } from '@/Pages/Personal/types';

    const props = defineProps<{
        errors: IErrors;
        flash: {
            message?: string;
        };
        posts: [];
    }>();

    const form = useForm<IForm>({
        title: '',
        content: '',
        image: null,
    });

    const imagePreviewUrl = ref<string | null>(null);
    const fileInput = ref<HTMLInputElement | null>(null);

    const handleFileChange = (event: Event) => {
        const target = event.target as HTMLInputElement;
        if (target.files && target.files[0]) {
            const file = target.files[0];
            form.image = file;
            imagePreviewUrl.value = URL.createObjectURL(file);
        }
    };

    const resetImage = () => {
        form.image = null;
        imagePreviewUrl.value = null;
        if (fileInput.value) {
            fileInput.value.value = '';
        }
    };

    const submit = () => {
        form.post(route('post.store'), {
            onSuccess: () => form.reset('title', 'content', 'image'),
        });
        imagePreviewUrl.value = null;
        if (fileInput.value) {
            fileInput.value.value = '';
        }
    };

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
    <Head title="Personal" />
    <main-layout>
        <div class="mx-auto max-w-2xl rounded-lg bg-white p-6 shadow-md">
            <h1 class="mb-4 text-center text-xl font-bold">Create new Post</h1>
            <form class="space-y-6" @submit.prevent="submit">
                <div>
                    <input
                        class="w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        v-model="form.title"
                        type="text"
                        placeholder="Title"
                    />
                    <div class="mt-2 text-sm text-red-600" v-if="props.errors.title">
                        {{ props.errors.title }}
                    </div>
                </div>

                <div>
                    <textarea
                        class="w-full rounded border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        v-model="form.content"
                        rows="5"
                        placeholder="Content"
                    ></textarea>
                    <div class="mt-2 text-sm text-red-600" v-if="props.errors.content">
                        {{ props.errors.content }}
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between space-x-4">
                        <input
                            class="block w-full text-sm text-gray-500 file:mr-4 file:cursor-pointer file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                            ref="fileInput"
                            type="file"
                            @change="handleFileChange"
                        />
                        <button
                            class="text-nowrap rounded-full border-0 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100"
                            v-if="form.image"
                            type="button"
                            @click="resetImage"
                        >
                            Reset Image
                        </button>
                    </div>
                    <div class="mt-4" v-if="imagePreviewUrl">
                        <img
                            class="mx-auto h-auto max-h-96 max-w-full rounded"
                            :src="imagePreviewUrl"
                            alt="Image Preview"
                        />
                    </div>
                </div>

                <div>
                    <button
                        class="w-full rounded bg-blue-500 py-3 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
                        type="submit"
                        :disabled="form.processing"
                    >
                        Publish
                    </button>
                </div>
            </form>
            <div v-if="props.posts">
                <div v-for="post in props.posts" :key="post.id">
                    <h1>{{ post.title }}</h1>
                    <p>{{ post.content }}</p>
                    <img
                        class="mx-auto h-auto max-h-96 max-w-full rounded"
                        :src="post.image"
                        alt="Image Preview"
                    />
                </div>
            </div>
        </div>
    </main-layout>
</template>
