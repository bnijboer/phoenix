<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="mb-5 text-sm text-gray-600">Dit is een beveiligd onderdeel. Geef je wachtwoord op om door te kunnen gaan.</div>

            <breeze-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="password" value="Wachtwoord" />
                    <breeze-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
                </div>

                <div class="flex justify-end mt-4">
                    <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Bevestigen</breeze-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        data() {
            return {
                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.confirm'), {
                    onFinish: () => this.form.reset(),
                })
            }
        }
    }
</script>
