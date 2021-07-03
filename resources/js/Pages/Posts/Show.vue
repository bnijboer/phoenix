<template>
    <post :post="post" />
    
    <tags v-show="post.tags.length" :tags="post.tags" />
    
    <div class="flex justify-between mt-10">
        <back-link />
        
        <div v-if="owner" class="flex justify-end">
            <inertia-link :href="route('posts.edit', post)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                Bewerken
            </inertia-link>
            
            <form @submit.prevent="form.delete(route('posts.destroy', post))">
                <submit-button class="ml-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Verwijderen</submit-button>
            </form>
        </div>
    </div>
    
    <comments :post="post" />
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import BackLink from '@/Components/BackLink.vue';
    import Comments from '@/Components/Comments'
    import Post from '@/Components/Post';
    import SubmitButton from '@/Components/Button';
    import Tags from '@/Components/Tags'

    export default {
        components: {
            BackLink,
            Comments,
            Post,
            SubmitButton,
            Tags,
        },
        
        inheritAttrs: false,

        props: {
            post: Object,
        },
        
        setup () {
            const form = useForm();

            return { form };
        },
        
        computed: {
            owner() {
                if (this.user) {
                    return this.$page.props.auth.user.is_editor || this.$page.props.auth.user.is_admin;
                }
            },
            
            user() {
                return this.$page.props.auth.user;
            },
        }
    }
</script>
