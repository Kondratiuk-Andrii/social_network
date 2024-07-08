<script setup lang="ts">
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { useUserStore } from '@/stores/user/User';

    const userStore = useUserStore();
</script>

<template>
    <MainLayout>
        <h1 class="text-3xl font-bold">Hello, World!</h1>
    </MainLayout>
</template>

<style scoped></style>
