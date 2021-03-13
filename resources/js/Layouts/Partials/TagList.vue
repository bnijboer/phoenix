<template>
    <div class="bg-white p-4">
        <ul>
            <li v-for="tag in tags" :key="tag.name" class="capitalize">
                {{ tag.name }}
            </li>
        </ul>
    </div>
</template>

<script>
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/inertia-vue3'

    export default {
        setup() {
            const tags = computed(() => usePage().props.value.tags);
            
            return { tags };
        },
    }
</script>