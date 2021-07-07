<template>
    <div class="text-gray-400">
        <span class="font-semibold mr-2">Tags:</span>
        
        <div v-for="tag in tags" :key="tag.keyword" class="inline-flex">
            <inertia-link :href="route('tags.show', tag)">
                <div class="border rounded capitalize p-2 mr-1 hover:text-gray-600">{{ tag.keyword }}</div>
            </inertia-link>
        </div>
    </div>
</template>

<script>
    export default {
        inheritAttrs: false,

        props: {
            tags: Object,
        },
    }
</script>