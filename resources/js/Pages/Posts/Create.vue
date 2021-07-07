<template>
    <form @submit.prevent="submit">
        <div>
            <form-label for="title" />
            <form-input id="title" type="text" placeholder="Titel" class="mt-1 block w-full" v-model="form.title" required autofocus />
            <validation-error :message="form.errors.title" />
        </div>
        
        <div class="mt-4">
            <tiptap ref="body" />
        </div>

        <!-- <div class="mt-4">
            <form-label for="body" />
            <form-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required />
            <validation-error :message="form.errors.body" />
        </div> -->

        <!-- <div class="mt-4">
            <form-label for="image" />
            <form-input id="image" type="file" class="mt-1 block w-full" @change="selectFile" />
            <validation-error :message="form.errors.image" />
        </div> -->

        <div class="mt-4 inline-flex" v-for="(tag, index) in form.tags" :key="index">
            <form-label :for="`keyword${index}`" />
            <form-input :id="`keyword${index}`" type="text" :placeholder="`Tag ${index + 1}`" v-model="tag.keyword" class="capitalize" />
            <validation-error :message="form.errors.tags" />

            <div class="mx-1">
                <button @click="removeTag(index)" v-show="index || (!index && form.tags.length > 1)" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-minus-circle" />
                </button>
                
                <button @click="addTag()" v-show="index === form.tags.length - 1" class="text-green-500 hover:text-green-700 ml-1">
                    <i class="fas fa-plus-circle" />
                </button>
            </div>
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

        inheritAttrs: false,

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

            selectFile(event) {
                this.form.image = event.target.files[0];
            },

            submit() {
                this.form.body = this.$refs.body.editor.getHTML();
                
                this.form.post(route('posts.store'), this.form);
            },
        },
    }
</script>
