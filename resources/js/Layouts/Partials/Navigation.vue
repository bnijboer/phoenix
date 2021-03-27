<template>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:flex">
                <breeze-nav-link :href="route('posts.index')" :active="route().current('posts.index')">Home</breeze-nav-link>

                <breeze-nav-link :href="route('about')" :active="route().current('about')">Over mij</breeze-nav-link>

                <breeze-nav-link v-if="owner" :href="route('posts.create')" :active="route().current('posts.create')">Nieuw bericht</breeze-nav-link>
            </div>
            
            <search-bar />
        </div>
    </div>
</template>

<script>
    import BreezeNavLink from '@/Components/NavLink';
    import SearchBar from '@/Layouts/Partials/SearchBar';

    export default {
        components: {
            BreezeNavLink,
            SearchBar,
        },
        
        computed: {
            owner() {
                return this.$page.props.auth.user.is_editor || this.$page.props.auth.user.is_admin;
            },
        }
    }
</script>
