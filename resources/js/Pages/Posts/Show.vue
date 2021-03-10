<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <post :post="post" />

        <back-button />
    </layout-master>
</template>

<script>
    import BackButton from '../../Components/BackButton.vue'
    import LayoutMaster from '@/Layouts/Master'
    import Post from '@/Components/Post'

    export default {
        components: {
            BackButton,
            LayoutMaster,
            Post,
        },

        props: {
            post: Object,
        },
    }
</script>
