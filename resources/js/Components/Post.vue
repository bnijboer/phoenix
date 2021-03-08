<template>
    <div class="font-semibold mb-3">
        {{ post.title }}
    </div>
    
    <div class="text-gray-600 italic mb-3">
        {{ formattedDate }}
    </div>
    
    <div class="text-gray-600">
        {{ post.body }}
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
