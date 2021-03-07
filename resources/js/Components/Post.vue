<!--<template>-->
<!--    <div>-->
<!--        {{ post.title }}-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    export default {-->
<!--        props: {-->
<!--            post: Object,-->
<!--        }-->
<!--    }-->
<!--</script>-->


<template>
    <div>
        <div class="font-semibold">
            {{ post.title }}
        </div>
        <div class="text-gray-600">
            {{ post.body }}
        </div>
        <div class="text-gray-600">
<!--            {{ post.user.name }}-->
        </div>

        <hr class="my-5">
    </div>
</template>

<script>
    // import { onMounted } from "vue";

    export default {
        props: {
            post: Object,
        },

        // filters: {
        //     truncate(string, words) {
        //         return string.split(' ').splice(0, words).join(' ') + '...';
        //     }
        // },

        // setup () {
        //     onMounted(() => {
        //         console.log('mounted in the composition api!')
        //     })
        // }
    }
</script>
