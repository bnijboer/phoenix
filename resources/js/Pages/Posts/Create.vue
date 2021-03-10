<template>
    <layout-master>
        <template #header>Nieuw bericht</template>

        <form @submit.prevent="submit">
            <div>
                <post-label for="title" />
                <post-input id="title" type="text" placeholder="Titel" class="mt-1 block w-full" v-model="form.title" required autofocus />
            </div>
            
            <div>
                <post-label for="body" />
                <post-input id="body" type="text" placeholder="Inhoud" class="mt-1 block w-full" v-model="form.body" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <post-submit-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Aanmaken
                </post-submit-button>
            </div>
        </form>
        
        <back-link />
    </layout-master>
</template>

<script>
    import BackLink from '@/Components/BackLink.vue'
    import LayoutMaster from '@/Layouts/Master'
    import PostInput from '@/Components/Input'
    import PostLabel from '@/Components/Label'
    import PostSubmitButton from '@/Components/Button'
    import PostValidationErrors from '@/Components/ValidationErrors'

    export default {
        components: {
            BackLink,
            LayoutMaster,
            PostInput,
            PostLabel,
            PostSubmitButton,
            PostValidationErrors,
        },
        
        data() {
            return {
                form: this.$inertia.form({
                    title: '',
                })
            }
        },
        
        
        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                    }))
                    .post(this.route('posts.store'), {
                        // onFinish: () => this.form.reset('password'),
                        // console.log('gelukt');
                    })
            }
        }
    }
</script>
