<a href="{{ route('user.post.show', ['categorySlug' => $post->category->slug, 'id' => $post->id]) }}"
    title="{{ $post->title }}" class="text-decoration-none">
    <div class="position-relative text-white {{ $index == 1 ? 'pb-2' : '' }}">
        <img class="img-responsive w-100 rounded" src="{{ $post->image }}" alt="{{ $post->title }}">
        <div class="position-absolute" style="bottom: 12px; left: 14px;">
            <h3>
                <span class="badge bg-light text-dark">{{ $post->category->name }}</span>
            </h3>
            <span class="d-block font-weight-bold fs-3">{{ $post->title }}</span>
        </div>
    </div>
</a>
