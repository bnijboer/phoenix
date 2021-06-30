<template>
    <div :class="isPreview ? 'preview' : ''">
        <div v-if="unpublished" class="text-center text-gray-700 font-bold bg-red-300 rounded-md p-3 mb-3">Nog niet gepubliceerd</div>
        
        <div class="flex post-header" :class="isPreview ? 'mb-9' : 'mb-12'">
            <div class="post-date w-16 tracking-wider text-gray-500 font-bold border-4 border-purple-400 rounded-sm">{{ date }}</div>
            
            <div class="w-full">
                <div class="post-title bg-purple-200 tracking-wide text-2xl text-gray-700 rounded-md">{{ post.title }}</div>
            </div>
        </div>
        
        <div>
            <div class="post-body text-gray-600 p-3" v-html="post.body" />
            
            <div :class="isPreview ? 'bg-fade-to-white' : ''" />
        </div>
    </div>
</template>

<script>
    import { format, isFuture, parseISO } from 'date-fns'
    import { nl } from 'date-fns/locale';

    export default {
        props: {
            preview: Boolean,
            post: Object,
        },
        
        computed: {
            date() {
                return format(
                    parseISO(this.post.published_at ?? this.post.created_at),
                    'd MMM',
                    { locale: nl },
                )
            },
            
            isPreview() {
                return this.preview;
            },
            
            unpublished() {
                return isFuture(parseISO(this.post.published_at));
            }
        }
    }
</script>
