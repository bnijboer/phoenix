<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="text-center mb-5">
                <h2>Account aanmaken</h2>
            </div>

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="first_name" value="Voornaam" />
                    
                    <breeze-input id="first_name" type="text" class="form-input" v-model="form.first_name" required autofocus autocomplete="first_name" />
                    
                    <validation-error :message="form.errors.first_name" />
                </div>
                
                <div class="mt-6">
                    <breeze-label for="last_name" value="Achternaam" />
                    
                    <breeze-input id="last_name" type="text" class="form-input" v-model="form.last_name" required autocomplete="last_name" />
                    
                    <validation-error :message="form.errors.last_name" />
                </div>
                
                <div class="mt-6">
                    <breeze-label for="username" value="Gebruikersnaam" />
                    
                    <breeze-input id="username" type="text" class="form-input" v-model="form.username" required />
                    
                    <validation-error :message="form.errors.username" />
                </div>

                <div class="mt-4">
                    <breeze-label for="email" value="E-mail" />
                    
                    <breeze-input id="email" type="email" class="form-input" v-model="form.email" required autocomplete="email" />
                    
                    <validation-error :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password" value="Wachtwoord" />
                    
                    <breeze-input id="password" type="password" class="form-input" v-model="form.password" required />
                    
                    <validation-error :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password_confirmation" value="Wachtwoord bevestigen" />
                    
                    <breeze-input id="password_confirmation" type="password" class="form-input" v-model="form.password_confirmation" required />
                    
                    <validation-error :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">Heb je al een account?</inertia-link>

                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Registreren</breeze-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeCheckbox from "@/Components/Checkbox";
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import ValidationError from '@/Components/InputError';

    export default {
        components: {
            BreezeButton,
            BreezeCheckbox,
            BreezeInput,
            BreezeLabel,
            ValidationError,
        },

        data() {
            return {
                form: this.$inertia.form({
                    first_name: '',
                    last_name: '',
                    username: '',
                    avatar: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
