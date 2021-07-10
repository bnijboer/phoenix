<template>
    <div class="flex justify-between text-gray-600 text-sm">
        <div class="pt-1">
            Reactie van&#160;<span class="font-bold">{{ comment.user.username }}</span>   
        </div>
        
        <div class="italic">{{ formattedDate }} geleden</div>
    </div>
    
    <div class="text-gray-800 my-5">{{ comment.content }}</div>
    
    <div v-if="comment.permissions.delete" class="flex justify-end text-gray-600 text-sm mb-3">
        <button @click.prevent="remove" class="text-red-500 hover:text-red-700">
            <i class="fas fa-trash" />
        </button>
    </div>
</template>

<script>
    import { formatDistance, parseISO } from 'date-fns';
    import { nl } from 'date-fns/locale';

    export default {
        props: {
            comment: Object,
        },
        
        inheritAttrs: false,
        
        computed: {
            formattedDate() {
                return formatDistance(
                    parseISO(this.comment.created_at),
                    new Date(),
                    { locale: nl },
                );
            },
            
            remove() {
                this.$emit('remove');
            }
        }
    }
</script>
