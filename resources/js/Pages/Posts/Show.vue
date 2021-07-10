<template>
    <post :post="post" />
    
    <hr class="my-4">
    
    <tags v-show="post.tags.length" :tags="post.tags" />
    
    <div class="flex justify-between mt-10">
        <back-link />
        
        <div class="flex justify-end">
            <inertia-link v-if="post.permissions.update" :href="route('posts.edit', post)" class="btn btn-yellow">Bewerken</inertia-link>
            
            <form v-if="post.permissions.delete" @submit.prevent="form.delete(route('posts.destroy', post))">
                <submit-button :class="['btn-red ml-2', { 'opacity-25': form.processing }]" :disabled="form.processing">Verwijderen</submit-button>
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
    }
</script>
