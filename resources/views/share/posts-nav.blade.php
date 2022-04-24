<div class="row mt--50">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="product__nav nav justify-content-center" role="tablist">
            <a class="nav-item nav-link{{ !request()->query('tab') || request()->query('tab') == 'all' ? ' active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['tab' => 'all']) }}">
                Tất cả
            </a>
            <a class="nav-item nav-link{{ request()->query('tab') == 'hot' ? ' active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['tab' => 'hot']) }}">
                Tin Nóng
            </a>
            <a class="nav-item nav-link{{ request()->query('tab') == 'newest' ? ' active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['tab' => 'newest']) }}">
                Mới Nhất
            </a>
            <a class="nav-item nav-link{{ request()->query('tab') == 'popular' ? ' active' : '' }}"
                href="{{ request()->fullUrlWithQuery(['tab' => 'popular']) }}">
                Xem nhiều
            </a>
        </div>
    </div>
</div>
