<template>
    <layout-master>
        <template #header>Nieuwe Post</template>

        Create Post
        
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
    }
</script>
