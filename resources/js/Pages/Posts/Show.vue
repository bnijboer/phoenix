<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <post :post="post" />

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

        props: {
            post: Object,
        },
    }
</script>
