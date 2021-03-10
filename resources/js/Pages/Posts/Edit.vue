<template>
    <layout-master>
        <template #header>Bericht bewerken</template>

        Edit Post

        <back-link />
    </layout-master>
</template>

<script>
    import BackLink from '@/Components/BackLink.vue'
    import LayoutMaster from '@/Layouts/Master'

    export default {
        components: {
            BackLink,
            LayoutMaster,
        },

        props: {
            post: Object,
        },
    }
</script>
