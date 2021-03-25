<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link :href="route('posts.index')" class="text-sm text-gray-700 underline">
                Blog
            </inertia-link>

            <inertia-link v-if="!user" :href="route('login')" class="ml-4 text-sm text-gray-700 underline">
                Log in
            </inertia-link>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            user() {
                return this.$page.props.auth.user;
            },
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