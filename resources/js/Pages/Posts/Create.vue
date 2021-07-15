<template>
    <form @submit.prevent="form.post(route('posts.store'), form)">
        <div>
            <form-label for="title" value="Titel" />
            
            <form-input id="title" type="text" placeholder="Titel" class="form-input" v-model="form.title" autofocus />
            
            <validation-error :message="form.errors.title" />
        </div>
        
        <div class="mt-6">
            <form-label value="Inhoud" />
            
            <tiptap ref="body" @input="getBody" />
            
            <validation-error :message="form.errors.body" />
        </div>

        <div class="mt-6">
            <form-label value="Tags" />
            
            <div class="inline-flex mb-3" v-for="(tag, index) in form.tags" :key="index">
                <form-input :id="`keyword${index}`" type="text" :placeholder="`Tag ${index + 1}`" v-model="tag.keyword" class="capitalize" />
                
                <validation-error :message="form.errors.tags" />

                <div class="mr-3">
                    <a class="text-red-500 hover:text-red-700 ml-1" @click="removeTag(index)" v-show="index || (!index && form.tags.length > 1)">
                        <i class="fas fa-minus-circle" />
                    </a>
                    
                    <a class="text-green-500 hover:text-green-700 ml-1" v-show="index === form.tags.length - 1" @click="addTag">
                        <i class="fas fa-plus-circle" />
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <form-label for="date-picker" value="Publicatiedatum" />
            
            <form-input id="date-picker" type="date" class="mt-1 block" :min="min" v-model="form.published_at" />
            
            <validation-error :message="form.errors.published_at" />
        </div>

        <div class="flex justify-between mt-10">
            <back-link />

            <submit-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Aanmaken</submit-button>
        </div>
    </form>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3';
    import { format } from 'date-fns'
    import BackLink from '@/Components/BackLink';
    import FormInput from '@/Components/Input';
    import FormLabel from '@/Components/Label';
    import SubmitButton from '@/Components/Button';
    import Tiptap from '@/components/Tiptap'
    import ValidationError from '@/Components/InputError';

    export default {
        components: {
            BackLink,
            FormInput,
            FormLabel,
            SubmitButton,
            Tiptap,
            ValidationError,
        },

        setup () {
            const form = useForm({
                title: null,
                body: null,
                image: null,
                published_at: format(new Date(), 'yyyy-MM-dd'),
                tags: [{
                    keyword: null,
                }],
            });

            return { form };
        },

        computed: {
            min() {
                return format(new Date(), 'yyyy-MM-dd');
            }
        },

        methods: {
            addTag() {
                this.form.tags.push({
                    keyword: null,
                });
            },

            removeTag(index) {
                this.form.tags.splice(index, 1);
            },
            
            getBody(value) {
                this.form.body = value;
            }
        },
    }
</script>
