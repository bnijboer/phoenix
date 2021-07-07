<template>
    <div class="flex justify-center mt-8">
        <div class="w-80">
            <div class="mb-5 text-sm text-gray-600">Voordat je je account kan gebruiken moet je eerst je e-mailadres verifiëren. Klik op de link in de e-mail die je ontvangen hebt.</div>

            <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">Er is een verificatielink naar het door jou opgegeven e-mailadres gestuurd.</div>

            <form @submit.prevent="submit">
                <div class="mt-4 flex items-center justify-between">
                    <breeze-button :class="['btn-green', { 'opacity-25': form.processing }]" :disabled="form.processing">Stuur verificatie e-mail opnieuw</breeze-button>

                    <inertia-link :href="route('logout')" method="post" as="button" class="btn btn-blue">Log Out</inertia-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'

    export default {
        components: {
            BreezeButton,
        },

        props: {
            status: String
        },

        data() {
            return {
                form: this.$inertia.form()
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('verification.send'))
            },
        },

        computed: {
            verificationLinkSent() {
                return this.status === 'verification-link-sent';
            }
        }
    }
</script>
