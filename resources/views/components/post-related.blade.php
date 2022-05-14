<div class="row g-0 bg-white text-dark rounded shadow mb-3">
    <div class="col-md-6">
        <a href="{{ route('user.post.show', ['categorySlug' => $relatedPost->category->slug, 'id' => $relatedPost->id]) }}" title="{{ $relatedPost->title }}" class="text-decoration-none">
            <img class="w-100 image-responsive rounded"
                src="{{ $relatedPost->image }}"
                alt="{{ $relatedPost->title }}">
        </a>
    </div>
    <div class="col-md-6 p-2 d-flex flex-column justify-content-between">
        <div>
            <a href="{{ route('user.post.show', ['categorySlug' => $relatedPost->category->slug, 'id' => $relatedPost->id]) }}" title="{{ $relatedPost->title }}" class="text-decoration-none text-dark">
                <h4>{{ $relatedPost->title }}</h4>
            </a>
            <p>
                {{ $relatedPost->content_resume }}
            </p>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('user.post.show', ['categorySlug' => $relatedPost->category->slug, 'id' => $relatedPost->id]) }}" class="text-decoration-none text-dark font-weight-bold fs-6 text-right">
                Xem thêm
            </a>
        </div>
    </div>
</div>
