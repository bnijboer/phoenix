<template>
    <div class="mt-8 bg-gray-100 p-4 rounded">
        <div class="text-center font-semibold">
            Reacties:
            
            <hr class="my-3">
        </div>
                
        <div class="p-4">
            <div v-if="user">
                <div v-if="comments.length">
                    <div v-for="(comment, index) in comments" :key="comment.id">
                        <comment :comment="comment" @remove="del(comment, index)" />

                        <hr class="my-3">
                    </div>
                </div>
                <div v-else class="text-center">
                    <div v-if="!owner">
                        Hé {{ user.username }}, wat vind je van deze blogpost?
                    </div>
                    <div v-else>
                        Er zijn nog geen reacties.
                    </div>
                    
                    <hr class="mt-8">
                </div>
                
                <form class="mt-5" @submit.prevent="submit(form)" ref="comment">
                    <div>
                        <form-label for="content" />
                        <form-input id="content" type="text" placeholder="Bericht" class="mt-1 block w-full" v-model="form.content" required />
                        <validation-error :message="form.errors.content" />
                    </div>
                    
                    <div class="flex justify-end mt-3">
                        <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Reageren</submit-button>
                    </div>
                </form>
            </div>
            <div v-else class="text-center">
                <div>Registreer om te kunnen reageren en reacties te lezen.</div>
                
                <div>
                    <inertia-link :href="route('register')" class="ml-4 text-lg text-gray-700 underline">Registeren</inertia-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import Comment from '@/Components/Comment'
    import FormInput from '@/Components/Input';
    import FormLabel from '@/Components/Label';
    import SubmitButton from '@/Components/Button';
    import ValidationError from '@/Components/InputError';

    export default {
        components: {
            Comment,
            FormInput,
            FormLabel,
            SubmitButton,
            ValidationError,
        },
        
        inheritAttrs: false,

        props: {
            post: Object,
        },
        
        setup () {
            const form = useForm({
                content: null,
            });

            return { form };
        },
        
        computed: {
            comments() {
                return this.post.comments;
            },
            
            owner() {
                return this.$page.props.auth.user.is_editor || this.$page.props.auth.user.is_admin;
            },
            
            user() {
                return this.$page.props.auth.user;
            },
        },
        
        methods: {
            del(comment, index) {
                const url = route('posts.comments.destroy', [this.post, comment]);

                axios.delete(url).then(() => {
                    this.comments.splice(index, 1);
                });
            },
            
            submit(form) {
                const url = route('posts.comments.store', this.post);
                
                axios.post(url, form).then((response) => {
                    this.comments.push(response.data);
                    this.form.reset('content');
                }).catch(error => {
                    console.log(error.response.data.errors.content);
                });
            },
        },
    }
</script>
