<template>
    <div>
        <div>
            <div class="font-semibold mb-3">
                {{ post.title }}
            </div>
            
            <div class="flex justify-between text-gray-600 italic mb-3">
                <div>
                    Door: {{ post.user.name }}
                </div>
                
                <div>
                    {{ formattedDate }}
                </div>
            </div>
            
            <div v-if="indexResult" class="text-gray-600">
                {{ truncatedBody }}
            </div>
            <div v-else class="text-gray-600">
                {{ post.body }}
            </div>
        </div>
        
        <hr v-if="indexResult" class="my-5">
    </div>
</template>

<script>
    import { format, parseISO } from 'date-fns'

    export default {
        props: {
            post: Object,
            indexResult: String,
        },
        
        computed: {
            formattedDate() {
                return format(parseISO(this.post.created_at), 'd MMM. yyyy')
            },
            
            truncatedBody() {
                return this.post.body.split(' ').splice(0, 10).join(' ') + '...';
            }
        }
    }
</script>
