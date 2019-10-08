@extends('layout')
@section('content')

    <header-component
        image="{{ Voyager::image($post->image ) }}"
        title="{{ $post->title }}"
        additional_class="centered-image"
    >
    </header-component>

    <section class="section-divider">
        <div class="card-text">
            {!! $post->content !!}
        </div>
    </section>

    <photoswipe-gallery-component :images="{{ json_encode($gallery) }}"></photoswipe-gallery-component>

    <div class="spacer"></div>
    @include('photoswipe-layout')
@endsection

















