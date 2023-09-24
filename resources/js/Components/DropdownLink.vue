<template>
    <Link class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-[#014E82] dark:hover:bg-slate-600  hover:text-white ">
        <slot />
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
