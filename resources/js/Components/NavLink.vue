<template>
    <Link :href="href" :class="classes">
        <slot name="icon" />
        <span class="mx-3">
            <slot />
        </span>
    </Link>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center mt-3 py-3 px-8 bg-[#0284c7] rounded-md dark:bg-[#0c4a6e] text-gray-100'
    : 'flex items-center mt-3  py-2 px-8 text-gray-100'
);
</script>
