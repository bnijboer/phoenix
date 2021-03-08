<template>
    <div class="flex flex-col min-h-screen justify-between bg-gray-100">
        <div class="h-full">
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
                    <slot name="header" />
                </div>
            </header>

            <section class="flex">
                <main class="w-full">
                    <slot />
                </main>

                <section class="hidden md:block w-96">
                    <biography />
                </section>
            </section>
        </div>

        <footer class="bg-white">
            <div class="text-center p-4">
                Footer
            </div>
        </footer>
    </div>
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
