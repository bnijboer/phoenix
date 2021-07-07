<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="text-center mb-5">
                <h2>Inloggen</h2>
            </div>
            
            <breeze-validation-errors class="mb-4" />

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">{{ status }}</div>

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="email" value="E-mail" />
                    <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password" value="Wachtwoord" />
                    <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <breeze-checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Onthoud mij</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">Wachtwoord vergeten?</inertia-link>

                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Inloggen</breeze-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeInput from '@/Components/Input'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
