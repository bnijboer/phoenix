<template>
    <layout-master>
        <template #header>Nieuw bericht</template>

        <form @submit.prevent="submit(form)">
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
            
            <div class="mt-4">
                <form-label for="keywords" />
                <form-input id="keywords" type="text" placeholder="Tags: Honden, Happy, Hen" class="mt-1 block w-full" v-model="form.keywords" />
                <validation-error :message="form.errors.keywords" />
            </div>
            
            <div class="mt-4">
                <form-label for="date-picker" />
                <form-input
                    id="date-picker"
                    type="date"
                    class="mt-1 block w-full"
                    :min="min"
                    v-model="form.published_at"
                    required />
                <validation-error :message="form.errors.published_at" />
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
    import { format } from 'date-fns'
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
                keywords: null,
                published_at: format(new Date(), 'yyyy-MM-dd'),
            });

            return { form };
        },
        
        computed: {
            min() {
                return format(new Date(), 'yyyy-MM-dd');
            }
        },

        methods: {
            selectFile(event) {
                this.form.image = event.target.files[0];
            },
            
            submit(form) {
                form.post(route('posts.store'), form);
            },
        },
    }
</script>
