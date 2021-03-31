<template>
    <div class="min-h-screen flex flex-col justify-center bg-gray-100 dark:bg-gray-900">
        <div class="flex justify-center">
            <inertia-link :href="route('posts.index')" as="button" class="text-sm text-gray-700 underline">Blog</inertia-link>
            
            <div v-if="user">
                <inertia-link :href="route('logout')" method="post" as="button" class="ml-4 text-sm text-gray-700 underline">Uitloggen</inertia-link>
            </div>
            <div v-else class="flex">
                <inertia-link :href="route('login')" as="button" class="ml-4 text-sm text-gray-700 underline">Inloggen</inertia-link>
                
                <inertia-link :href="route('register')" as="button" class="ml-4 text-sm text-gray-700 underline">Registeren</inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            user() {
                return this.$page.props.auth.user ? true : false;
            },
        },
        
        methods: {
            auth() {
                return this.$page.props.auth.user ? true : false;
            }
        }
    }
</script>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }
    }
</style>