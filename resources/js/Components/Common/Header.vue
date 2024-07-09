<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { Ref, ref } from 'vue';
    import MobileMenu from '@/Components/Common/MobileMenu.vue';
    import Dropdown from '@/Components/Shared/Dropdown.vue';
    import DropdownLink from '@/Components/Shared/DropdownLink.vue';
    import NavLink from '@/Components/Shared/NavLink.vue';
    import { useUserStore } from '@/store/user/User';

    const userStore = useUserStore();
    const isMenuOpen: Ref<boolean> = ref(false);

    const toggleMenu = (): void => {
        isMenuOpen.value = !isMenuOpen.value;
    };
</script>

<template>
    <header class="relative left-0 top-0 z-10 w-full bg-slate-600 text-white">
        <div class="container mx-auto flex min-h-16 items-center justify-between gap-4 px-4 py-2.5">
            <Link :href="route('home')">
                <h1 class="text-xl font-bold">My Website</h1>
            </Link>
            <nav
                class="flex items-center justify-center gap-3 text-center llg:hidden"
                v-if="userStore.isAuthenticated"
            >
                <NavLink :active="route().current('home')" :href="route('home')">Home</NavLink>
                <NavLink :active="route().current('posts')" href="#">All Posts</NavLink>
                <NavLink :active="route().current('post')" href="#">Create Post</NavLink>
            </nav>
            <Dropdown
                class="llg:hidden"
                v-if="userStore.isAuthenticated"
                content-classes="llg:hidden bg-slate-600 text-white"
            >
                <template #trigger>
                    <button class="flex items-center justify-center gap-2 focus:outline-none">
                        <span v-if="userStore.user">{{ userStore.user.name }}</span>
                        <span v-else>Menu</span>
                        <v-icon name="md-arrowdropdown" scale="1.2" />
                    </button>
                </template>
                <template #content>
                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                    <DropdownLink :href="route('user.personal.index')">Personal</DropdownLink>
                    <DropdownLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </DropdownLink>
                </template>
            </Dropdown>
            <div class="flex gap-3 llg:hidden" v-else>
                <NavLink :active="route().current('login')" :href="route('login')">Login</NavLink>
                <NavLink :active="route().current('register')" :href="route('register')">
                    Register
                </NavLink>
            </div>
            <button class="hidden focus:outline-none llg:block" @click="toggleMenu">
                <v-icon :name="isMenuOpen ? 'md-close' : 'md-menu'" scale="1.5" />
            </button>
        </div>
        <MobileMenu :is-menu-open="isMenuOpen" :is-auth="userStore.isAuthenticated" />
    </header>
</template>
