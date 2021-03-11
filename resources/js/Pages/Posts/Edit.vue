<template>
    <layout-master>
        <template #header>Bericht bewerken</template>

        <form @submit.prevent="form.patch(route('posts.update', post), form)">
            <div>
                <post-label for="title" />
                <post-input id="title" type="text" placeholder="Titel" class="mt-1 block w-full" v-model="form.title" required autofocus />
                <input-error :message="form.errors.title" />
            </div>
            
            <div class="mt-4">
                <post-label for="body" />
                <post-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required autofocus />
                <input-error :message="form.errors.body" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <post-submit-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Opslaan
                </post-submit-button>
            </div>
        </form>

        <back-link />
    </layout-master>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    import BackLink from '@/Components/BackLink.vue'
    import InputError from '@/Components/InputError'
    import LayoutMaster from '@/Layouts/Master'
    import PostInput from '@/Components/Input'
    import PostLabel from '@/Components/Label'
    import PostSubmitButton from '@/Components/Button'
    
    export default {
        components: {
            BackLink,
            InputError,
            LayoutMaster,
            PostInput,
            PostLabel,
            PostSubmitButton,
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
