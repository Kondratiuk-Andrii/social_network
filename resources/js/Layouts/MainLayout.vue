<script setup lang="ts">
    import Header from '@/Layouts/Partials/Header.vue';
</script>

<template>
    <div class="flex h-screen flex-col bg-gray-100">
        <!-- Header -->
        <Header />
        <!-- Main Content -->
        <main class="flex flex-1 overflow-auto">
            <div class="container mx-auto px-4">
                <div class="py-12">
                    <slot></slot>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="flex bg-slate-600 p-3 text-white">
            <div class="container mx-auto flex items-center justify-between text-center">
                &copy; 2024 My Website
            </div>
        </footer>
    </div>
</template>
