@extends('admin.auth.layout')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Đặt lại mật khẩu!</h1>
    </div>
    @include('share.alert')
    <form action="{{ route('admin.reset-password.process') }}" method="POST" class="user" autocomplete="off">
        @csrf
        @method('PUT')
        <input type="hidden" name="reset_token" value="{{ request()->query('token') }}">
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="input_password" name="password" placeholder="Nhập mật khẩu mới" autofocus>
            @error('password')
                <div id=input_passwordFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="input_password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu mới">
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Lưu
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('admin.login.index') }}">Quay lại đăng nhập!</a>
    </div>
@endsection
