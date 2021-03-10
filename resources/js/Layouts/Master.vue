<template>
    <div class="wrapper">
        <nav v-if="$page.props.auth.user" class="bg-white">
            <navigation />
        </nav>

        <header class="flex bg-white">
            <div class="flex-shrink-0 flex items-center pl-4 sm:pl-6 lg:pl-8">
                <inertia-link :href="route('landing')">
                    <breeze-application-logo class="block h-9 w-auto" />
                </inertia-link>
            </div>
            
            <div v-if="$slots.header" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <slot name="header" />
                </h2>
            </div>
        </header>

        <section class="">
            <div class="flex bg-gradient-overlay">
                <main class="w-full">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white shadow-md overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <section class="hidden md:block w-96">
                    <biography />
                </section>
            </div>
        </section>
    </div>

    <footer class="bg-white">
        <div class="text-center p-4">
            Footer
        </div>
    </footer>
</template>

<script>
    import Biography from '@/Layouts/Partials/Biography';
    import BreezeApplicationLogo from '@/Components/ApplicationLogo'
    import Navigation from '@/Layouts/Partials/Navigation';

    export default {
        components: {
            Biography,
            BreezeApplicationLogo,
            Navigation,
        },
    }
</script>
