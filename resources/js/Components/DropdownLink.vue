<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

    const props = withDefaults(
        defineProps<{
            href: string;
            linkClasses?: string;
        }>(),
        {
            linkClasses:
                'hover:bg-gray-700 hover:text-white focus:outline-none active:translate-y-0.5',
        }
    );
</script>

<template>
    <Link
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-white transition duration-150 ease-in-out"
        :href="props.href"
        :class="props.linkClasses"
    >
        <slot />
    </Link>
</template>
