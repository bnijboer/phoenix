<template>
    <layout-master>
        <template #header>Bericht bewerken</template>

        <form @submit.prevent="form.patch(route('posts.update', post), form)">
            <post-input field="title"
                        type="text"
                        v-model="form.title"
                        placeholder="Titel"
                        :message="form.errors.body" />
            
            <div class="mt-4">
                <form-label for="body" />
                <form-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required />
                <validation-error :message="form.errors.body" />
            </div>
            
            <div class="flex ml-auto w-96 mt-4">
                <form-label for="name" />
                <form-input id="name" type="text" placeholder="Tags" class="mt-1 block w-full" v-model="form.name" />
                <validation-error :message="form.errors.name" />
            </div>

            <div class="flex justify-between mt-10">
                <back-link />
            
                <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Opslaan
                </submit-button>
            </div>
        </form>
    </layout-master>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import BackLink from '@/Components/BackLink.vue';
    import FormInput from '@/Components/Input';
    import FormLabel from '@/Components/Label';
    import LayoutMaster from '@/Layouts/Master';
    import PostInput from '@/Components/PostInput';
    import SubmitButton from '@/Components/Button';
    import ValidationError from '@/Components/InputError';
    
    export default {
        components: {
            BackLink,
            LayoutMaster,
            FormInput,
            FormLabel,
            PostInput,
            SubmitButton,
            ValidationError,
        },
        
        inheritAttrs: false,
        
        props: {
            post: Object,
        },
        
        setup (props) {
            const form = useForm({
                title: props.post.title,
                body: props.post.body,
                name: null,
            });

            return { form };
        },
    }
</script>
