<template>
    <layout-master>
        <template #header>Bericht bewerken</template>

        <form @submit.prevent="form.patch(route('posts.update', post), form)">
            <div>
                <form-label for="title" />
                <form-input id="title" type="text" placeholder="Titel" class="mt-1 block w-full" v-model="form.title" required autofocus />
                <validation-error :message="form.errors.title" />
            </div>
            
            <div class="mt-4">
                <form-label for="body" />
                <form-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required />
                <validation-error :message="form.errors.body" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <submit-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Opslaan
                </submit-button>
            </div>
        </form>

        <back-link />
    </layout-master>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    import BackLink from '@/Components/BackLink.vue'
    import FormInput from '@/Components/Input'
    import FormLabel from '@/Components/Label'
    import LayoutMaster from '@/Layouts/Master'
    import SubmitButton from '@/Components/Button'
    import ValidationError from '@/Components/InputError'
    
    export default {
        components: {
            BackLink,
            LayoutMaster,
            FormInput,
            FormLabel,
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
            });

            return { form };
        },
    }
</script>
