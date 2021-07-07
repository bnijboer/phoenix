<template>
    <div class="py-2">
        <inertia-link :href="href" :class="'navlink'">
            <slot />
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ['href', 'active'],
    }
</script>
