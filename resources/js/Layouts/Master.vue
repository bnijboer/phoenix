<template>
    <div class="wrapper">
        <header class="flex bg-white pt-8">
            <div v-if="$slots.header" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <slot name="header" />
                </h2>
            </div>
        </header>
        
        <nav class="lg:hidden bg-white">
            <navigation />
        </nav>

        <section class="flex bg-gradient-overlay antialiased pb-14">
            <main class="mx-auto w-full sm:w-5/6 md:w-3/4 lg:w-1/2 bg-white border-b border-gray-200 sm:rounded-b-lg px-3 sm:px-6 md:px-9 lg:px-12 py-12">
                <div class="overflow-hidden">
                    <slot />
                </div>
            </main>

            <section class="hidden lg:block w-1/3">
                <div class="bg-white p-12">
                    <navigation />
                    
                    <div v-if="route().current() !== 'about'">
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
    import Biography from '@/Layouts/Partials/Biography';
    import Navigation from '@/Layouts/Partials/Navigation';

    export default {
        components: {
            Biography,
            Navigation,
        },
    }
</script>
