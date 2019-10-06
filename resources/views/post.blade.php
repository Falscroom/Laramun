@extends('layout')
@section('content')

    <header-component
        image="{{ Voyager::image($post->image ) }}"
        title="{{ $post->title }}" >
    </header-component>

    <section style="margin-top: 30px">
        <div class="card-text">
            {!! $post->content !!}
        </div>
    </section>

    <photoswipe-gallery-component :images="{{ json_encode($gallery) }}"></photoswipe-gallery-component>

    <div class="spacer"></div>
    @include('photoswipe-layout')
@endsection

















