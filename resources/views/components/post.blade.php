<div class="row g-0 bg-white text-dark rounded shadow mb-3">
    <div class="col-md-4">
        <a href="{{ route('user.post.show', ['categorySlug' => $post->category->slug, 'id' => $post->id]) }}"
            title="{{ $post->title }}" class="text-decoration-none">
            <img class="w-100 image-responsive rounded" src="{{ $post->image }}" alt="{{ $post->title }}">
        </a>
    </div>
    <div class="col-md-8 p-2 p-md-3 d-flex flex-column justify-content-between">
        <div>
            <a href="{{ route('user.post.show', ['categorySlug' => $post->category->slug, 'id' => $post->id]) }}" title="{{ $post->title }}" class="text-decoration-none text-dark">
                <h2>{{ $post->title }}</h2>
            </a>
            <p>
                {{ $post->content_resume }}
            </p>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('user.post.show', ['categorySlug' => $post->category->slug, 'id' => $post->id]) }}" title="{{ $post->title }}"
                class="text-decoration-none text-dark font-weight-bold fs-6 text-right">
                Xem thêm
            </a>
        </div>
    </div>
</div>
