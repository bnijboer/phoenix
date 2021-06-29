<template>
    <div class="wrapper">
        <top-bar />

        <header class="flex bg-white pt-8">
            <div v-if="$slots.header" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <slot name="header" />
                </h2>
            </div>
        </header>
        
        <nav class="bg-white">
            <navigation />
        </nav>

        <section>
            <div class="flex bg-gradient-overlay">
                <main class="w-full">
                    <div class="py-12">
                        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white shadow-md overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <!-- <section class="hidden md:block w-96"> -->
                    <!-- <biography /> -->
                <!-- </section> -->
            </div>
        </section>
    </div>

    <footer class="bg-white">
        <div class="text-center p-4">Footer</div>
    </footer>
</template>

<script>
    import Biography from '@/Layouts/Partials/Biography';
    import Navigation from '@/Layouts/Partials/Navigation';
    import TopBar from '@/Layouts/Partials/TopBar';

    export default {
        components: {
            Biography,
            Navigation,
            TopBar,
        },
    }
</script>
