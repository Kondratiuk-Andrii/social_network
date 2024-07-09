<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { computed } from 'vue';

    const props = defineProps<{
        href: string;
        active?: boolean;
    }>();

    const classes = computed(() =>
        props.active
            ? 'text-white px-3 py-2 rounded-md text-md font-medium bg-indigo-600 focus:outline-none cursor-default'
            : 'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-md font-medium focus:outline-none active:translate-y-0.5 active:ring-2 active:ring-offset-2 active:ring-gray-500'
    );
</script>

<template>
    <Link :href="props.active ? '#' : props.href" :class="classes">
        <slot />
    </Link>
</template>
