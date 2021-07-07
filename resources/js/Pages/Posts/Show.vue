<template>
    <post :post="post" />
    
    <hr class="my-4">
    
    <tags v-show="post.tags.length" :tags="post.tags" />
    
    <div class="flex justify-between mt-10">
        <back-link />
        
        <div v-if="owner" class="flex justify-end">
            <inertia-link :href="route('posts.edit', post)" class="btn btn-yellow">Bewerken</inertia-link>
            
            <form @submit.prevent="form.delete(route('posts.destroy', post))">
                <submit-button :class="['btn-red ml-2', { 'opacity-25': form.processing }]" :disabled="form.processing">Verwijderen</submit-button>
            </form>
        </div>
    </div>
    
    <!-- <div class="text-center">
        <inertia-link :href="route('posts.show', this.previousPost)" class="btn btn-blue">Vorige post</inertia-link>
    
        {{ previousPost }}
    </div> -->
    
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
            
            previousPost() {
                axios.get(route('posts.previous', this.post))
                    .then(response => {return response.data});
            }
        }
    }
</script>
