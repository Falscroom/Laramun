<template>
    <div class="row">
        <div class="col-12 col-sm-4 col-md-3 partner">
            <img :src=image class="partner-image" alt="partner image">
            <p class="partner-text">{{ text }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "partner",
        props: {
            image: String,
            text: String
        }
    }
</script>

<style scoped lang="scss">
    @import '../../../sass/_breakpoints.scss';
    .partner {
        .partner-image {
            max-width: 100%;
        }
        .partner-text {
            font-weight: 600;
            text-align: center;
            font-size: 1.2em;

            @include md {
                font-size: 0.9em;
            }
            @include lg {
                font-size: 1em;
            }
        }
    }
</style>
