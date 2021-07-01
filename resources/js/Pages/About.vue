<template>
    <layout-master>
        <template #header>The Goddess In Me</template>
        
        <biography />
    </layout-master>
</template>

<script>
    import Biography from '@/Layouts/Partials/Biography';
    import LayoutMaster from '@/Layouts/Master';

    export default {
        components: {
            Biography,
            LayoutMaster,
        },
        
        inheritAttrs: false,
    }
</script>
