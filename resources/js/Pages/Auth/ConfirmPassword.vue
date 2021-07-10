<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="mb-5 text-sm text-gray-600">Dit is een beveiligd onderdeel. Geef je wachtwoord op om door te kunnen gaan.</div>

            <form @submit.prevent="submit">
                <div>
                    <breeze-label for="password" value="Wachtwoord" />
                    
                    <breeze-input id="password" type="password" class="form-input" v-model="form.password" required autofocus />
                    
                    <validation-error :message="form.errors.password" />
                </div>

                <div class="flex justify-end mt-6">
                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Bevestigen</breeze-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import ValidationError from '@/Components/InputError';

    export default {
        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            ValidationError,
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
