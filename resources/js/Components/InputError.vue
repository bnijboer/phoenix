<template>
    <div v-show="message" class="text-sm text-red-600 mt-2">{{ message }}</div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
