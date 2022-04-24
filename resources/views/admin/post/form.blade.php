<form class="row" action="{{ !$post ? route('admin.posts.store') : route('admin.posts.update', $post) }}"
    method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if ($post)
        @method('PUT')
    @endif
    <div class="col-md-4">
        <div class="form-group">
            <label for="input_title">Tiêu đề</label>
            <input type="text" class="form-control form-control-user @error('title') is-invalid @enderror"
                id="input_title" name="title" value="{{ !old('title') ? ($post ? $post->title : '') : old('title') }}"
                placeholder="Nhập tiêu đề (quyết định SEO)" autofocus>
            @error('title')
                <div id="input_titleFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="input_category_id">Thể loại</label>
            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id"
                id="input_category_id">
                <option value="">-- Chọn thể loại --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ((!old('category_id') && !is_null($post) && $post->category_id == $category->id) || (old('category_id') && old('category_id') == $category->id))
                        selected
                @endif>
                {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
                <div id="input_category_idFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">Ảnh bìa</div>
        @if (is_null($post))
            <div>
                <div id="image_view" class="position-relative" style="display: none;">
                    <img id="image_output" class="w-100 h-100 rounded">
                    <a href="#" title="Xoá ảnh" id="image_btn_remove" class="position-absolute text-white"
                        style="top: 8px; right:8px;">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
                <div id="image_btn">
                    @error('image')
                        <div id="input_imageFeedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="file" class="d-none @error('image') is-invalid @enderror" name="image" accept="image/*"
                        id="input_image">
                    <div class="text-center">
                        <button class="btn btn-sm btn-outline-primary mt-2" id="btn_image">
                            <i class="fas fa-upload"></i>
                            Chọn ảnh
                        </button>
                    </div>
                </div>
            </div>
        @else
            @if (file_exists(public_path() . '/storage/posts/' . $post->image_name))
                <div id="image_view" class="position-relative">
                    <img id="image_output" class="w-100 h-100 rounded" src="{{ $post->image }}">
                    <a href="#" title="Xoá ảnh" id="image_btn_remove" class="position-absolute text-white"
                        style="top: 8px; right:8px;">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
            @endif
            <div class="text-center">
                <input type="hidden" id="post_id" value="{{ $post->id }}">
                <input type="hidden" id="old_image_name" value="{{ $post->image_name }}">
                <input type="file" class="d-none" name="image" accept="image/*" id="input_image_edit">
                <button class="btn btn-sm btn-outline-primary mt-2" id="btn_image_edit">
                    <i class="fas fa-upload"></i>
                    Chọn ảnh mới
                </button>
            </div>
        @endif
    </div>
    <div class="col-md-8">
        <label for="input_content">Nội dung</label>
        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="input_content"
            rows="5">
            {{ !old('content') ? $post->content ?? '' : old('content') }}
        </textarea>
        @error('content')
            <div id="input_contentFeedback" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 text-right">
        <button class="btn btn-success" type="submit">
            {{ !$post ? 'Thêm mới' : 'Cập nhật' }}
        </button>
    </div>
</form>
@push('script')
    <script type="text/javascript">
        $(function() {
            ClassicEditor
                .create(document.querySelector('#input_content'), {

                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'link',
                            'bulletedList',
                            'numberedList',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'blockQuote',
                            'insertTable',
                            'undo',
                            'redo'
                        ]
                    },
                    language: 'vi',
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    },
                    licenseKey: '',
                })
                .then(editor => {
                    window.editor = editor;
                })
                .catch(error => {
                    console.error('Oops, something went wrong!');
                    console.error(error);
                });
        });
    </script>
@endpush
