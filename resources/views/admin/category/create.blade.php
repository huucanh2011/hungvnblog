@extends('admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Thêm mới thể loại</h1>
            <a href="{{ route('admin.categories.index') }}">
                <i class="fas fa-long-arrow-alt-left"></i>
                Quay lại
            </a>
        </div>
        @include('share.alert')
        {{-- <div id="message-box"></div> --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                @include('admin.category.form', [$category = null])
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
