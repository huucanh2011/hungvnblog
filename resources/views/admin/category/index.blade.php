@extends('admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Danh sách thể loại</h1>
        </div>
        @include('share.alert')
        <div id="message-box"></div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <form action="{{ route('admin.categories.index') }}" method="GET" class="form-inline w-100">
                        <input type="text" class="form-control bg-light mr-2" placeholder="Tìm kiếm..." aria-label="Search"
                            name="q" value="{{ request()->query('q') }}" autocomplete="off">
                        <button class="btn btn-primary mr-2" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                            Lọc
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary" type="button">
                            Xoá lọc
                        </a>
                    </form>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="far fa-plus-square fa-sm"></i>
                    Thêm
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Stt.</th>
                                <th>Tên thể loại</th>
                                <th>Sắp xếp</th>
                                <th>Ngày đăng</th>
                                <th>Ngày cập nhật</th>
                                <th class="text-center">Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->display_order }}</td>
                                    <td>{{ $category->created_at_formated }}</td>
                                    <td id="updated_at_{{ $category->id }}">{{ $category->updated_at_formated }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.categories.edit', $category) }}" title="Sửa"
                                            class="btn btn-sm btn-primary mr-2">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button data-id="{{ $category->id }}" data-type="categories" title="Xoá" data-toggle="modal"
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
                @if ($categories->count() > 0)
                    {{ $categories->onEachSide(2)->links() }}
                @endif
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    @include('share.del-model')
    @include('admin.post.view-modal')
@endsection
