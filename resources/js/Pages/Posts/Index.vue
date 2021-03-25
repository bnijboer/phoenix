<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <div v-if="posts.length">
            <div v-for="post in posts" :key="post.id">
                <inertia-link :href="route('posts.show', post)">
                    <div class="preview">
                        <post :post="post" />
                        
                        <div class="read-more">
                            <span>Meer lezen<i class="fas fa-angle-double-right text-gray-600 ml-2" /></span>
                        </div>
                    </div>
                </inertia-link>

                <hr class="my-5">
            </div>
        </div>
        <div v-else class="text-center">Er zijn geen blogposts gevonden.</div>
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
        
        inheritAttrs: false,

        props: {
            posts: Object,
        },
    }
</script>
