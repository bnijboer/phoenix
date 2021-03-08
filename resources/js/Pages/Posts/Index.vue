<template>
    <layout-master>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                The Goddess In Me
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-for="post in posts" :key="post.id">
                            <inertia-link :href="route('posts.show', post)">
                                <post :post="post" />
                                
                                <div class="mt-5">Read more<i class="fas fa-angle-double-right text-gray-600 ml-2" /></div>
                            </inertia-link>
        
                            <hr class="my-5">
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
