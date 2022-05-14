<header class="sticky-top navbar navbar-expand-lg navbar-light bg-white text-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link text-capitalize{{ str_contains(request()->url(), $category->slug) ? ' active' : '' }}"
                            href="{{ route('user.post.index', ['categorySlug' => $category->slug]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </form>
        </div>
    </div>
</header>
