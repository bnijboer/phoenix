<template>
    <form @submit.prevent="form.get(route('search'))">
        <div class="flex">
            <div class="flex-grow h-14">
                <form-label for="query" />
                        
                <form-input :class="'h-full w-full'" id="query" type="search" placeholder="Zoekterm(en)" v-model="form.query" required />
                
                <validation-error :message="form.errors.query" />
            </div>
            
            <div class="flex-none w-14 h-14">
                <submit-button :class="['btn-blue h-full w-full ml-1', { 'opacity-25': form.processing }]" :disabled="form.processing">
                    <i class="fas fa-search fa-xl pl-1" />
                </submit-button>
            </div>
        </div>
    </form>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    import FormInput from '@/Components/Input'
    import FormLabel from '@/Components/Label';
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