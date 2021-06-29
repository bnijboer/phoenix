<template>
    <div class="border-2 border-dark">
        <div class="flex">
            <div class="w-1/4 bg-purple-100">
                <div class="post-date w-16 text-center text-gray-500 font-bold bg-white border-4 border-purple-400 p-2 m-3">
                    <span v-if="unpublished">Wordt gepubliceerd op </span>{{ date }}
                </div>
            </div>
            
            <div class="w-3/4 bg-indigo-200">
                <div class="post-title text-2xl p-2">{{ post.title }}</div>
            </div>
        </div>
        
        <div class="p-3">
            <div class="post-body text-gray-800 p-3" v-html="post.body" />
        </div>
    </div>
</template>

<script>
    import { format, isFuture, parseISO } from 'date-fns'
    import { nl } from 'date-fns/locale';

    export default {
        props: {
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
            
            unpublished() {
                return isFuture(parseISO(this.post.published_at));
            }
        }
    }
</script>
