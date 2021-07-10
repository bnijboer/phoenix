<template>
    <label class="block font-medium text-xs tracking-wider text-gray-600 mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
