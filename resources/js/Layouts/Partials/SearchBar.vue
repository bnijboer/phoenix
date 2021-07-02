<template>
    <form @submit.prevent="form.get(route('search'))">
        <div class="flex">
            <div>
                <form-label for="query" />
                <form-input id="query" type="search" placeholder="Zoekterm(en)" v-model="form.query" required />
                <validation-error :message="form.errors.query" />
            </div>
            
            <div>
                <submit-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="h-full ml-1">
                    <i class="fas fa-search" />
                </submit-button>
            </div>
        </div>
    </form>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    import FormInput from '@/Components/Input'
    import FormLabel from '@/Components/Label'
    import SubmitButton from '@/Components/Button'
    import ValidationError from '@/Components/InputError'
    
    export default {
        components: {
            FormInput,
            FormLabel,
            SubmitButton,
            ValidationError,
        },
        
        inheritAttrs: false,
        
        setup () {
            const form = useForm({
                query: null,
            });

            return { form };
        },
    }
</script>