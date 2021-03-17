<template>
    <layout-master>
        <template #header>Nieuw bericht</template>

        <form @submit.prevent="form.post(route('posts.store'), form)">
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
            
            <div class="mt-4">
                <form-label for="image" />
                <form-input id="image" type="file" class="mt-1 block w-full" @change="selectFile" />
                <validation-error :message="form.errors.image" />
            </div>
            
            <div class="flex justify-between mt-10">
                <back-link />
                
                <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Aanmaken
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
    import SubmitButton from '@/Components/Button';
    import ValidationError from '@/Components/InputError';
    
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
        
        setup () {
            const form = useForm({
                title: null,
                body: null,
                image: null,
            });

            return { form };
        },

        methods: {
            selectFile(event) {
                this.form.image = event.target.files[0];
            },
        }
    }
</script>
