<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <div v-if="posts.data.length">
            <div v-for="post in posts.data" :key="post.id">
                <inertia-link :href="route('posts.show', post)">
                    <div class="preview">
                        <post :post="post" />
                    </div>
                </inertia-link>

                <hr class="my-5">
            </div>
            
            <pagination class="mt-6" :links="posts.links" />
        </div>
        <div v-else class="text-center">Er zijn geen blogposts gevonden.</div>
    </layout-master>
</template>

<script>
    import LayoutMaster from '@/Layouts/Master'
    import Pagination from '@/Components/Pagination'
    import Post from '@/Components/Post'

    export default {
        components: {
            LayoutMaster,
            Pagination,
            Post,
        },
        
        inheritAttrs: false,

        props: {
            posts: Object,
        }
    }
</script>
