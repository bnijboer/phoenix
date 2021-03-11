<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <post :post="post" />
        
        <inertia-link :href="route('posts.edit', post)">
            Edit
        </inertia-link>

        <back-link />
    </layout-master>
</template>

<script>
    import BackLink from '@/Components/BackLink.vue'
    import LayoutMaster from '@/Layouts/Master'
    import Post from '@/Components/Post'

    export default {
        components: {
            BackLink,
            LayoutMaster,
            Post,
        },
        
        inheritAttrs: false,

        props: {
            post: Object,
        },
    }
</script>
