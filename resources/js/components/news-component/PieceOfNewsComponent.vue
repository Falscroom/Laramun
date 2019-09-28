<template>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <a class="post-link-wrapper" href="">
            <article class="card">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="card-date">
                    </div>
                    <h2 class="card-title" style="margin-top: 10px">
                    </h2>
                    <p class="card-text">
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

<style scoped>
    @import '../../../sass/_breakpoints.scss';


</style>
