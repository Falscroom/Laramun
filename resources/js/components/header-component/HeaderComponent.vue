<template>
    <div class="header-component">
        <h1 class="header-component__title">{{ title }}</h1>
        <div class="d-lg-block header-component__wrapper" :class=additional_class>
            <img class="header-component__image" :src="image" alt="main image">
        </div>
    </div>
</template>

<script>
    export default {
        props:['image', 'title', 'additional_class'],
    }
</script>

<style lang="scss">
    @import '../../../sass/_breakpoints.scss';

    .header-component {
        &__title {
            font-size: 2em;
            text-align: center;
            margin: 30px 0;

            @include lg {
                font-size: 1.7em;
            }
            @include md {
                font-size: 1.2em;
            }
        }
        &__wrapper {
            max-height: 350px;
            overflow: hidden;
        }
        &__image {
            width: 100%;
        }
    }
</style>
