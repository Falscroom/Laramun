@extends('layout')

@section('content')
    @inject('postService', 'App\Http\Services\PostService')
    <header-component
        image="{{ asset('/images/main_image.jpg') }}"
        title="Model United Nations of the Russian Far East"
        additional_class="d-none d-md-none">
    </header-component>

    <section class="section" id="section-news">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Latest News</div>
            <div class="col"><hr></div>
        </div>

        <div class="row" id="news-grid">
            @foreach ($posts as $post)
                <news-component
                    href="{{ route('post', ['id' => $post->id]) }}"
                    image="{{ $postService->preparePreview($post) }}"
                    title="{{ $post->title }}"
                    content="{{ $postService->prepareContent($post) }}"
                ></news-component>
            @endforeach
            <div class="col-sm-12 col-md-12 col-lg-4 grid-sizer"></div>
        </div>

        <div class="more-container">
            <span class="more-text">All news</span>
        </div>
    </section>

    <section class="section" id="section-contacts">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Contacts</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <partner-component
                    image="{{ asset('/images/vk.svg') }}"
                    link="www.vk.com/munrfe"
                ></partner-component>

                <partner-component
                    image="{{ asset('/images/insta.svg') }}"
                    link="www.instagram.com/munrfe"
                ></partner-component>
            </div>
            <div class="col-6 d-none d-md-none d-lg-block" id="contacts-image-container" >
                <img src="{{ asset('/images/group.jpg') }}" class="contacts-group-image"/>
            </div>
        </div>
    </section>

    <section class="section" id="section-partners">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Partners</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-4 col-md-3">
                <img src="{{ asset('/images/far-eastern-federal-university-526-logo.png') }}" class="partner-image">
                <p class="partner-text">Far Eastern Federal University</p>
            </div>
        </div>

        <div class="more-container">
            <span class="more-text">All partners</span>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        const newsSection = document.getElementById('news-grid');
        imagesLoaded(newsSection, function () {
            const masonry = new Masonry(newsSection, {
                itemSelector: '.grid-item',
                percentPosition: true,
                columnWidth: '.grid-sizer'
            });
        });
    </script>
@endsection
