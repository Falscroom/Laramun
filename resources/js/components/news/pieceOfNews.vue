<template>
    <div class="col-sm-12 col-md-12 col-lg-4 grid-item">
        <a class="post-link-wrapper" :href=href>
            <article class="card news-card">
                <img :src=image class="card-img-top" alt="news image">
                <div class="card-body">
                    <div class="card-date">
                        {{ date }}
                    </div>
                    <h2 class="card-title" style="margin-top: 10px">
                        {{ title }}
                    </h2>
                    <p class="card-text" v-html="content">
                        {{ content }}
                    </p>
                </div>
            </article>
        </a>
    </div>
</template>

<script>
    export default {
        name: "PieceOfNews",
        props: {
            href: String,
            image: String,
            date: String,
            title: String,
            content: String
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/_breakpoints.scss';

    .news-card {
        background-color: inherit;
        border: none;
        border-radius: 0;
        margin-bottom: 10px;

        .card-body {
            padding: 0 0 20px 0;

            .card-text {
                @include lg {
                    font-size: 0.9em;
                }
            }
            .card-date {
                font-size: 0.7em;
            }
            .card-title {
                font-size: 1.2em;
                @include md {
                    font-size: 0.9em;
                }
                @include lg {
                    font-size: 1em;
                }
            }
        }
    }
</style>
