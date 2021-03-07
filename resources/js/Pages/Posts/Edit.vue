<template>
    <layout-master>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Edit post
                    </div>
                </div>
            </div>
        </div>
    </layout-master>
</template>

<script>
    import LayoutMaster from '@/Layouts/Master'

    export default {
        components: {
            LayoutMaster,
        },

        props: {
            post: Object,
        },
    }
</script>
