@extends('admin.layout.main')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('share.alert')
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thay đổi thông tin cá nhân</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.updateInfo') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="input_name">Tên hiển thị</label>
                                <input type="text" class="form-control form-control-user @error('name') is-invalid @enderror"
                                    id="input_name" name="name" value="{{ old('name') ?? auth()->user()->name }}"
                                    placeholder="Nhập tên hiển thị">
                                @error('name')
                                    <div id="input_nameFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="input_email">Email</label>
                                <input type="text"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="input_email" name="email" value="{{ old('email') ?? auth()->user()->email }}"
                                    placeholder="Nhập tên hiển thị">
                                @error('email')
                                    <div id="input_emailFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Cập nhật thông tin
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thay đổi mật khẩu</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="input_current_password">Mật khẩu cũ</label>
                                <input type="password"
                                    class="form-control form-control-user @error('current_password') is-invalid @enderror"
                                    id="input_current_password" name="current_password" placeholder="Nhập mật khẩu cũ">
                                @error('current_password')
                                    <div id=input_current_passwordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="input_new_password">Mật khẩu mới</label>
                                <input type="password"
                                    class="form-control form-control-user @error('new_password') is-invalid @enderror"
                                    id="input_new_password" name="new_password" placeholder="Nhập mật khẩu mới">
                                @error('new_password')
                                    <div id=input_new_passwordFeedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="input_new_password_confirmation">Xác nhận mật khẩu mới</label>
                                <input type="password"
                                    class="form-control form-control-user @error('new_password') is-invalid @enderror"
                                    id="input_new_password_confirmation" name="new_password_confirmation"
                                    placeholder="Nhập lại mật khẩu mới">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Cập nhật mật khẩu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
