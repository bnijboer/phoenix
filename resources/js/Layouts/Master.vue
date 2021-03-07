<template>
    <div class="flex flex-col min-h-screen justify-between bg-gray-100">
        <div class="h-full">
            <nav class="bg-white">
                <navigation />
            </nav>

            <header v-if="$slots.header" class="bg-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <section class="flex">
                <main class="w-full">
                    <slot />
                </main>

                <section class="w-96">
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
    import Navigation from '@/Layouts/Partials/Navigation';

    export default {
        components: {
            Biography,
            Navigation,
        },
    }
</script>
