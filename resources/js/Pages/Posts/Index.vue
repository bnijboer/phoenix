<template>
    <layout-master>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-for="post in posts" :key="post.id">
                            <inertia-link :href="route('posts.show', post)">
                                <post indexResult="indexResult" :post="post" />
                            </inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout-master>
</template>

<script>
    import LayoutMaster from '@/Layouts/Master'
    import Post from '@/Components/Post'

    export default {
        components: {
            LayoutMaster,
            Post,
        },

        props: {
            posts: Object,
        },
    }
</script>
