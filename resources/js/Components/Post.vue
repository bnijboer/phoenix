<template>
    <div class="font-semibold mb-3">{{ post.title }}</div>
    
    <div class="text-gray-600 italic mb-3">
        <span v-if="unpublished">Wordt gepubliceerd op </span>{{ date }}
    </div>
    
    <div class="text-gray-800 mb-3">{{ post.body }}</div>
</template>

<script>
    import { format, isFuture, parseISO } from 'date-fns'

    export default {
        props: {
            post: Object,
        },
        
        computed: {
            date() {
                return format(parseISO(this.post.published_at ?? this.post.created_at), 'd MMM. yyyy')
            },
            
            unpublished() {
                return isFuture(parseISO(this.post.published_at));
            }
        }
    }
</script>
