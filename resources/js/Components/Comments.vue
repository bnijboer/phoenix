<template>
        <div v-if="post.comments.length">
            <div v-for="(comment, index) in post.comments" :key="comment.id">
                <comment :comment="comment" @remove="del(comment, index)" />

                <hr class="my-3">
            </div>
        </div>
        <div v-else class="text-center">Er zijn nog geen reacties.</div>
        
        <form @submit.prevent="submit" class="mt-5" ref="comment">
            <div>
                <form-label for="content" />
                <form-input id="content" type="text" placeholder="Bericht" class="mt-1 block w-full" v-model="form.content" required />
                <validation-error :message="form.errors.content" />
            </div>
            
            <div class="flex justify-end mt-3">
                <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Reageren</submit-button>
            </div>
        </form>
</template>

<script>
    import { useForm, usePage } from '@inertiajs/inertia-vue3';
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
                user_id: usePage().props.value.auth.user.id,
            });

            return { form };
        },
        
        methods: {
            del(comment, index) {
                const url = route('comments.destroy', [this.post, comment]);

                axios.delete(url).then(() => {
                    this.post.comments.splice(index, 1);
                });
            },
            
            submit() {
                this.form.post(route('comments.store', this.post));
                
                this.$refs.comment.reset();
            },
        },
    }
</script>
