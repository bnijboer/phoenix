<template>
    <div class="font-semibold mb-3">
        {{ post.title }}
    </div>
    
    <div class="text-gray-600 italic mb-3">
        {{ formattedDate }}
    </div>
    
    <div class="text-gray-800 mb-3">
        {{ post.body }}
    </div>
    
    <div v-if="post.tags.length" class="text-gray-600">
        <p class="mb-1">Tags:</p>
        
        <span v-for="tag in post.tags" :key="tag.name" class="mr-1 capitalize italic">
            <inertia-link :href="route('tags.show', tag)">
                #{{ tag.name }}
            </inertia-link>
        </span>
    </div>
</template>

<script>
    import { format, parseISO } from 'date-fns'

    export default {
        props: {
            post: Object,
        },
        
        computed: {
            formattedDate() {
                return format(parseISO(this.post.created_at), 'd MMM. yyyy')
            },
        }
    }
</script>
