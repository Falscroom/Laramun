@extends('layout')
@section('content')
    @inject('postService', 'App\Http\Services\PostService')
    <div>
        <h1 class="section-divider" style="text-align: center; margin-top: 60px; margin-bottom: 60px">
            All news
        </h1>
    </div>

    @foreach ($news as $item)
        <div class="row" style="margin-top: 40px; margin-bottom: 40px">
            <div class="col-4" >
                <img src="{{ $postService->preparePreview($item) }}" style="max-width: 100%">
            </div>
            <div class="col-8">
                <h2 style="font-size: 1.5em;">{{ $item->title }}</h2>
                <div style="font-size: 12px;  font-weight: 600; float: right; margin-right: 20px;">{{ $item->updated_at }}</div>
                <div style="font-size: 12px;  font-weight: 600">by {{$item->getUser()->name}}</div>
                <hr style="margin: 0px 20px 20px 0;">
                <div>{!! $postService->prepareContent($item) !!}</div>
            </div>
        </div>
    @endforeach

    {{ $news->links('pagination/bootstrap-4') }}

    <pagination-component paginationData="{{ $news->toJson() }}"></pagination-component>
@endsection

















