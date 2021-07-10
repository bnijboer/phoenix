<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="mb-5 text-sm text-gray-600">Als je je e-mailadres opgeeft dan zal je een link toegestuurd krijgen waarmee je een nieuw wachtwoord kan instellen.</div>

            <div v-if="status" class="mb-6 font-medium text-sm text-green-600">{{ status }}</div>

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="email" value="E-mail" />
                    
                    <breeze-input id="email" type="email" class="form-input" v-model="form.email" required autofocus autocomplete="email" />
                    
                    <validation-error :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Stuur mij een link</breeze-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import ValidationError from '@/Components/InputError'

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            ValidationError,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
