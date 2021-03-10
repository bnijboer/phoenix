<template>
    <layout-master>
        <template #header>Post Bewerken</template>

        Edit Post

        <back-button />
    </layout-master>
</template>

<script>
    import BackButton from '../../Components/BackButton.vue'
    import LayoutMaster from '@/Layouts/Master'

    export default {
        components: {
            BackButton,
            LayoutMaster,
        },

        props: {
            post: Object,
        },
    }
</script>
