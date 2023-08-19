<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-3 bg-[#014E82] hover:bg-[#0284c7]  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:#0284c7 focus:#014E82 active:#014E82 focus:outline-none focus:ring-2 focus:#014E82 focus:ring-offset-2 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
