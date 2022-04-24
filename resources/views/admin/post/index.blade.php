@extends('admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Danh sách bài đăng</h1>
        </div>
        @include('share.alert')
        <div id="message-box"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <form action="{{ route('admin.posts.index') }}" method="GET" class="form-inline w-100">
                        <select class="custom-select mr-2" name="category">
                            <option value="">Lọc theo lĩnh vực</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (request()->query('category') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control bg-light mr-2" placeholder="Tìm kiếm..." aria-label="Search"
                            name="q" value="{{ request()->query('q') }}" autocomplete="off">
                        <button class="btn btn-primary mr-2" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                            Lọc
                        </button>
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary" type="button">
                            Xoá lọc
                        </a>
                    </form>
                </div>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                    <i class="far fa-plus-square fa-sm"></i>
                    Thêm
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Stt.</th>
                                <th>Tiêu đề</th>
                                <th>Lĩnh vực</th>
                                <th>Lượt xem</th>
                                <th>Người đăng</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật</th>
                                <th class="text-center">Hiển thị</th>
                                <th class="text-center">Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ number_format($post->view) }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->created_at_formated }}</td>
                                    <td id="updated_at_{{ $post->id }}">{{ $post->updated_at_formated }}</td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input js-status-cbx"
                                                data-id="{{ $post->id }}" id="is_publish-{{ $post->id }}"
                                                @if ($post->is_publish) checked @endif>
                                            <label class="custom-control-label"
                                                for="is_publish-{{ $post->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button data-id="{{ $post->id }}" title="Xem"
                                            class="btn btn-sm btn-success mr-2 js-view-post">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.posts.edit', $post) }}" title="Sửa"
                                            class="btn btn-sm btn-primary mr-2">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button data-id="{{ $post->id }}" data-type="posts" title="Xoá" data-toggle="modal"
                                            data-target="#delModal" class="btn btn-sm btn-danger js-btn-del">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($posts->count() > 0)
                    {{ $posts->onEachSide(2)->links() }}
                @endif
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @include('share.del-model')
    @include('admin.post.view-modal')
@endsection
