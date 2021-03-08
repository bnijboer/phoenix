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
                        <post :post="post" />
                        
                         <inertia-link :href="route('posts.index')">
                             <i class="fas fa-angle-double-left text-gray-600 mt-5" />
                        </inertia-link>
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
            post: Object,
        },
    }
</script>
