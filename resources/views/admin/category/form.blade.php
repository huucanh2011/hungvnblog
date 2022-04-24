<form class="row" action="{{ !$category ? route('admin.categories.store') : route('admin.categories.update', $category) }}"
    method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if ($category)
        @method('PUT')
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label for="input_name">Tên thể loại</label>
            <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                id="input_name" name="name" value="{{ !old('name') ? ($category ? $category->name : '') : old('name') }}"
                placeholder="Nhập thể loại" autofocus>
            @error('name')
                <div id="input_nameFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="input_display_order">Sắp xếp</label>
            <input type="number" min="0" class="form-control form-control-user @error('display_order') is-invalid @enderror"
                id="input_display_order" name="display_order" value="{{ !old('display_order') ? ($category ? $category->display_order : '') : old('display_order') }}"
                placeholder="Nhập sắp xếp hiển thị">
            @error('display_order')
                <div id="input_display_orderFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-12 text-right">
        <button class="btn btn-success" type="submit">
            {{ !$category ? 'Thêm mới' : 'Cập nhật' }}
        </button>
    </div>
</form>
