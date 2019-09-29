<template>
    <div class="gallery-row">
        <div class="photoswipe-gallery no-gutters" v-bind:class="{invisible: isDisabled}" ref="gallery" itemscope itemtype="http://schema.org/ImageGallery">
            <div v-for="(item) in images" class="col-lg-3 col-md-4 col-6 pr-2 pl-2 grid-item">
                <figure class="photoswipe-gallery__item" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                    <a :href=item.image itemprop="contentUrl" :data-size="item.width + 'x' + item.height">
                        <img  :src=item.preview class="responsive-img item-image" itemprop="thumbnail" alt="Image description" />
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6 pr-2 pl-2 grid-sizer"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PhotoswipeGallery",
        data: function() {
            return {
                isDisabled: true
            }
        },
        props: {
            images: {
                type: Array,
                default: []
            }
        },
        mounted() {
            let current = this;
            const gallery = this.$refs.gallery;
            imagesLoaded(gallery, function() {
                const masonry = new Masonry(gallery, {
                    itemSelector: '.grid-item',
                    percentPosition: true,
                    columnWidth: '.grid-sizer'
                });
                masonry.on( 'layoutComplete', function() {
                    current.$data.isDisabled = false;
                });
                masonry.layout();
            });
        }
    }
</script>

<style lang="scss">
    @import '../../../sass/_breakpoints.scss';

    .photoswipe-gallery {
        margin-top: 50px;
        width: 100%;
        &__item {
            width: 100%;
            .item-image {
                width: 100%;
            }
        }
    }
    .gallery-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -8px;
        margin-left: -8px;
    }
</style>
