@extends('layout.main')
@section('content')
    @if (count($posts) > 0)
        @php
            $firstPosts = $posts->slice(0, 1);
        @endphp
        <div id="posts-top">
            @if (count($posts) >= 1)
                @include('components.post-top', ['post' => $firstPosts[0], 'index' => 0])
            @endif
        </div>
        <div id="posts-bottom" class="row g-0 mt-3">
            @if (count($posts) > 1)
                @foreach ($posts->slice(1, count($posts) - 1) as $post)
                    @include('components.post', compact('post'))
                @endforeach
            @endif
        </div>
    @else
        <p>Chưa có bài đăng nào</p>
    @endif
@endsection
