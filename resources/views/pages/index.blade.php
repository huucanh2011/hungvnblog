@extends('layout.main')
@section('content')
    @if (count($posts) > 0)
        @php
            $threeFirstPosts = $posts->slice(0, 3);
        @endphp
        <div id="posts-top" class="row g-0 d-flex align-content-stretch">
            <div class="col-md-8 pe-2">
                @if (count($posts) >= 1)
                    @include('components.post-top', ['post' => $threeFirstPosts[0], 'index' => 0])
                @endif
            </div>
            <div class="col-md-4">
                @if (count($posts) >= 2)
                    @include('components.post-top', ['post' => $threeFirstPosts[1], 'index' => 1])
                @endif
                @if (count($posts) >= 3)
                    @include('components.post-top', ['post' => $threeFirstPosts[2], 'index' => 2])
                @endif
            </div>
        </div>
        <div id="posts-bottom" class="row g-0 mt-3">
            @if (count($posts) > 3)
                @foreach ($posts->slice(1, count($posts) - 3) as $post)
                    @include('components.post', compact('post'))
                @endforeach
            @endif
        </div>
    @else
        <p>Chưa có bài đăng nào</p>
    @endif
@endsection
