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
            @foreach ($posts as $item)
                <news-component
                    href="{{ route('post', ['id' => $item->id]) }}"
                    image="{{ $postService->preparePreview($item) }}"
                    title="{{ $item->title }}"
                    content="{{ $postService->prepareContent($item) }}"
                ></news-component>
            @endforeach
            <div class="col-sm-12 col-md-12 col-lg-4 grid-sizer"></div>
        </div>

        <div class="more-container">
            <a class="more-text" href="{{ route('news') }}">All news</a>
        </div>
    </section>

    <section class="section" id="section-contacts">

        <div class="row section-divider flex-center">
            <div class="col-auto second-title" >Contacts</div>
            <div class="col"><hr></div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                @foreach ($contacts as $contact)
                    <contact-component
                        image="{{ Voyager::image($contact->image) }}"
                        link="{{ $contact->link }}"
                        title="{{ $contact->value }}"
                    ></contact-component>
                @endforeach
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
            @foreach ($partners as $partner)
                <partner-component
                    image="{{ Voyager::image($partner->image) }}"
                    link="{{ $partner->link }}"
                    title="{{ $partner->value }}"
                ></partner-component>
            @endforeach
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
