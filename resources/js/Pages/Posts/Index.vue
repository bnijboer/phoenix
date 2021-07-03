<template>
    <div v-if="posts.data.length">
        <div v-for="post in posts.data" :key="post.id">
            <inertia-link :href="route('posts.show', post)">
                <post :post="post" preview />
            </inertia-link>

            <hr class="mt-14 mb-10">
        </div>
        
        <pagination class="mt-6" :links="posts.links" />
    </div>
    <div v-else class="text-center">Er zijn geen blogposts gevonden.</div>
</template>

<script>
    import Pagination from '@/Components/Pagination'
    import Post from '@/Components/Post'

    export default {
        components: {
            Pagination,
            Post,
        },
        
        inheritAttrs: false,

        props: {
            posts: Object,
        },
    }
</script>
