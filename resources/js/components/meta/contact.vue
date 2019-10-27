<template>
    <div class="row contact">
        <div class="col-2">
            <img class="contacts-logo-image" :src=image alt="Contact logo">
        </div>
        <div class="col-10 flex-center">
            <a href="#" class="contacts-link"> {{ link }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "contact",
        props: {
            image: String,
            link: String
        }
    }
</script>

<style scoped lang="scss">
    @import '../../../sass/_breakpoints.scss';

    .contact {
        .contacts-logo-image {
            width: 100%;
            max-width: 70px;
            margin-bottom: 15px;
        }
        .contacts-link {
            font-size: 1.3em;
            font-weight: 600;
            color: #001630;

            word-break: break-all;
            word-wrap: break-word;
            white-space: normal;
            padding-bottom: 15px;

            @include md {
                font-size: 0.9em;
            }
            @include lg {
                font-size: 1em;
            }
        }
    }
</style>
