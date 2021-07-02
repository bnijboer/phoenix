<template>
    <div class="wrapper">
        <nav class="fixed w-screen bg-white px-3 py-6 z-10">
            <div class="flex justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex flex-shrink-0 items-center">
                    <inertia-link :href="route('home')">
                        <application-logo class="block h-9 w-auto" />
                    </inertia-link>
                </div>
    
                <div class="flex items-center">
                    <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="w-72 border border-gray-200 shadow-lg rounded-lg p-4 mt-1 mr-2 ml-auto">
                <nav-links />
            </div>
        </nav>
        
        <header v-if="$slots.header" class="bg-white text-center pt-32 pb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <slot name="header" />
            </h2>
        </header>

        <section class="flex bg-gradient-to-b from-white to-transparent antialiased pb-14">
            <main class="mx-auto w-full sm:w-5/6 md:w-3/4 lg:w-1/2 bg-white border-b border-gray-200 sm:rounded-b-lg px-3 sm:px-6 md:px-9 lg:px-12 py-12">
                <div class="overflow-hidden">
                    <slot />
                </div>
            </main>

            <section class="hidden lg:block w-1/3">
                <div class="bg-white p-12">
                    <nav-links />
                    
                    <div v-if="! route().current('about')">
                        <hr class="my-8">
                        
                        <biography />
                    </div>
                </div>
            </section>
        </section>
    </div>

    <footer class="flex flex-col justify-center">
        <div class="text-sm text-center text-gray-500 font-extralight tracking-wider ml-auto pr-4">&copy; 2021 BN</div>
    </footer>
</template>

<script>
    import ApplicationLogo from '@/Components/ApplicationLogo';
    import Biography from '@/Layouts/Partials/Biography';
    import NavLinks from '@/Layouts/Partials/NavLinks';

    export default {
        components: {
            ApplicationLogo,
            Biography,
            NavLinks,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        }
    }
</script>
