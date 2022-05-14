@extends('layout.main')
@section('content')
    <div class="bg-white rounded shadow-sm">
        <div class="p-2 py-md-4 px-md-5">
            <h3>
                <span class="badge bg-light text-dark">{{ $post->category->name }}</span>
            </h3>
            <span class="d-block font-weight-bold fs-3">{{ $post->title }}</span>
        </div>
        <img class="w-100 image-responsive" src="{{ $post->image }}" alt="">
        <div class="p-2 p-md-5 lh-lg">
            {!! $post->content !!}
        </div>
    </div>

    <div>
        <div class="font-weight-bold fs-5 text-uppercase my-3">Bạn cũng có thể thích</div>
        <div class="row mt-3">
            @foreach ($relatedPosts as $relatedPost)
                <div class="col-md-6">
                    @include('components.post-related', compact('relatedPost'))
                </div>
            @endforeach
        </div>
    </div>
@endsection
