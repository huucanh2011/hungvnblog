<div class="tab__container row mt--60 br-1">
    @forelse ($posts as $post)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="product product__style--3">
                <div class="product__thumb">
                    <a class="first__img hover-title"
                        href="{{ route('category.posts.index', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"
                        title="{{ $post->title }}">
                        <img class="lazy" data-original="{{ $post->image }}" alt="product image">
                    </a>
                    <a class="second__img animation1"
                        href="{{ route('category.posts.index', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"
                        title="{{ $post->title }}">
                        <img class="lazy" data-original="{{ $post->image }}" alt="product image">
                    </a>
                    @if ($post->is_hot)
                        <div class="hot__box">
                            <span class="hot-label">HOT</span>
                        </div>
                    @endif
                </div>
                <div class="product__content content--center content--center">
                    <div class="text-h4">
                        <h4>
                            <a class="hover-title"
                                href="{{ route('category.posts.index', ['categorySlug' => $post->category->slug, 'postSlug' => $post->slug]) }}"
                                title="{{ $post->title }}">
                                {{ $post->title }}
                            </a>
                        </h4>
                    </div>
                    <div class="td-module-meta-info">
                        <span class="td-post-author-name">
                            <a href="#">THT Legal services</a>
                            <span>-</span>
                        </span>
                        <span class="td-post-date">
                            <time class="entry-date updated td-module-date"
                                datetime="{{ $post->created_at_formated }}">
                                {{ $post->created_at_formated }}
                            </time>
                        </span>
                        <span class="td-module-comments">
                            <a href="#">{{ $post->view }}</a>
                        </span>
                    </div>
                    <div class="text-p">
                        <p>{!! $post->content_resume !!}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="w-100 text-center mb-5">Không có bài đăng nào phù hợp.</div>
    @endforelse
</div>
{{ $posts->links('vendor.pagination.custom-frontend') }}
