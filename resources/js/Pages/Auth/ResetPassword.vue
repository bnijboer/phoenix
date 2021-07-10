<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="text-center mb-5">
                <h2>Wachtwoord herstellen</h2>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="email" value="E-mail" />
                    
                    <breeze-input id="email" type="email" class="form-input" v-model="form.email" required autofocus autocomplete="email" />
                    
                    <validation-error :message="form.errors.email" />
                </div>

                <div class="mt-6">
                    <breeze-label for="password" value="Wachtwoord" />
                    
                    <breeze-input id="password" type="password" class="form-input" v-model="form.password" required />
                    
                    <validation-error :message="form.errors.password" />
                </div>

                <div class="mt-6">
                    <breeze-label for="password_confirmation" value="Wachtwoord bevestigen" />
                    
                    <breeze-input id="password_confirmation" type="password" class="form-input" v-model="form.password_confirmation" required />
                    
                    <validation-error :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Wachtwoord resetten</breeze-button>
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
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
