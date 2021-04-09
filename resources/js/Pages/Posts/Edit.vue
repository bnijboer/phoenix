<template>
    <layout-master>
        <template #header>Bericht bewerken</template>

        <form @submit.prevent="submit(form)">
            <div>
                <form-label for="title" />
                <form-input id="title" type="text" placeholder="Titel" class="mt-1 block w-full" v-model="form.title" required />
                <validation-error :message="form.errors.title" />
            </div>

            <div class="mt-4">
                <form-label for="body" />
                <form-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required />
                <validation-error :message="form.errors.body" />
            </div>

            <div class="mt-4 inline-flex" v-for="(tag, index) in form.tags" :key="index">
                <form-label :for="`keyword${index}`" />
                <form-input :id="`keyword${index}`" type="text" :placeholder="`Tag ${index + 1}`" v-model="tag.keyword" class="capitalize" />
                <validation-error :message="form.errors.tags" />

                <div>
                    <i class="fas fa-minus-circle" @click="removeTag(index)" v-show="index || (!index && form.tags.length > 1)" />
                    <i class="fas fa-plus-circle" @click="addTag()" v-show="index === form.tags.length - 1" />
                </div>
            </div>

            <div class="mt-4">
                <form-label for="date-picker" />
                <form-input
                    id="date-picker"
                    type="date"
                    class="mt-1 block w-full"
                    :min="formattedDate"
                    v-model="form.published_at"
                    required />
                <validation-error :message="form.errors.published_at" />
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
    import { format, parseISO } from 'date-fns'
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

        props: {
            post: Object,
            keywords: Array,
        },

        setup (props) {
            const form = useForm({
                title: props.post.title,
                body: props.post.body,
                published_at: format(parseISO(props.post.published_at), 'yyyy-MM-dd'),
                tags: props.keywords.length ? props.keywords : [{
                    keyword: null,
                }],
            });

            return { form };
        },

        computed: {
            formattedDate() {
                return format(parseISO(this.post.published_at), 'yyyy-MM-dd');
            },
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

            submit(form) {
                form.patch(route('posts.update', this.post), form)
            },
        }
    }
</script>
