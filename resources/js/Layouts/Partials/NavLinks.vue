<template>
    <div class="pl-8">
        <nav-link :href="route('posts.index')" :active="route().current('posts.index')">Home</nav-link>

        <nav-link :href="route('about')" :active="route().current('about')" :class="'lg:hidden'">Over mij</nav-link>
        
        <nav-link v-if="owner" :href="route('posts.create')" :active="route().current('posts.create')">Nieuwe blogpost</nav-link>
        
        <template v-if="user">
            <div class="py-2">
                <dropdown width="48">
                    <template #trigger>
                        <span class="inline-flex">
                            <button type="button" class="navlink">
                                Ingelogd als&#160;<span class="font-semibold">{{ user.username }}</span>

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <dropdown-link :href="route('logout')" method="post" as="button">Uitloggen</dropdown-link>
                    </template>
                </dropdown>
            </div>
        </template>
        <template v-else>
            <nav-link :href="route('login')" :active="route().current('login')">Inloggen</nav-link>
            
            <nav-link :href="route('register')" :active="route().current('register')">Registreren</nav-link>
        </template>
    </div>

    <div class="lg:w-72 mt-8 mx-auto">
        <search-bar />
    </div>
</template>

<script>
    import Dropdown from '@/Components/Dropdown';
    import DropdownLink from '@/Components/DropdownLink';
    import NavLink from '@/Components/NavLink';
    import SearchBar from '@/Layouts/Partials/SearchBar';

    export default {
        components: {
            Dropdown,
            DropdownLink,
            NavLink,
            SearchBar,
        },
        
        computed: {
            owner() {
                if (this.user) {
                    return this.user.is_editor || this.user.is_admin;
                }
            },
            
            user() {
                return this.$page.props.auth.user;
            }
        }
    }
</script>