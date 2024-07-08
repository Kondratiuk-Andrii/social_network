<script setup lang="ts">
    import { router } from '@inertiajs/vue3';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import { useUserStore } from '@/stores/user/User';

    const userStore = useUserStore();

    const props = defineProps<{
        isAuth: boolean;
        isMenuOpen: boolean;
    }>();
</script>

<template>
    <div
        class="fixed inset-x-0 bottom-12 top-15 bg-slate-600 bg-opacity-75 transition-transform duration-300"
        :class="props.isMenuOpen ? 'translate-x-0' : 'translate-x-full'"
    >
        <nav class="flex flex-col items-center px-4 pt-10 text-center text-xl font-bold text-white">
            <div class="mb-20 mt-10 flex flex-col gap-6" v-if="userStore.isAuthenticated">
                <NavLink :active="route().current('home')" :href="route('home')">Home</NavLink>
                <NavLink :active="route().current('posts')" href="#">All Posts</NavLink>
                <NavLink :active="route().current('post')" href="#">Create Post</NavLink>
            </div>
            <div class="flex flex-col gap-6" v-if="userStore.isAuthenticated">
                <NavLink :href="route('profile.edit')">Profile</NavLink>
                <NavLink :href="route('logout')" method="post" as="button">Log Out</NavLink>
            </div>
            <div class="flex flex-col gap-6" v-else>
                <NavLink :active="route().current('login')" :href="route('login')">Login</NavLink>
                <NavLink :active="route().current('register')" :href="route('register')">
                    Register
                </NavLink>
            </div>
        </nav>
    </div>
</template>

<style scoped></style>
