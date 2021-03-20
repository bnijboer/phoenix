<template>
    <div class="flex justify-between text-gray-600 text-sm">
        <div>
            <i class="fas fa-user mr-1"></i> {{ comment.user.name }}
        </div>
        
        <div class="italic">{{ formattedDate }} geleden</div>
    </div>
    
    <div class="text-gray-800 my-3">{{ comment.content }}</div>
    
    <div v-if="comment.user.id === $page.props.auth.user.id" class="flex justify-end text-gray-600 text-sm mb-3">
        <button @click.prevent="remove">
            <i class="fas fa-trash"/>
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
            },
        }
    }
</script>
