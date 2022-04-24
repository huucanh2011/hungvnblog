@extends('admin.auth.layout')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Chào mừng trở lại!</h1>
    </div>
    @include('share.alert')
    <form action="{{ route('admin.login.login') }}" method="POST" class="user">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                id="input_email" name="email" value="{{ old('email') }}"
                placeholder="Nhập email" autofocus>
            @error('email')
                <div id="input_emailFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"
                id="input_password" name="password" placeholder="Nhập mật khẩu">
            @error('password')
                <div id=input_passwordFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="input_remember_me" name="remember_me" value="r">
                <label class="custom-control-label" for="input_remember_me">Ghi nhớ đăng nhập</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Đăng nhập
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('admin.forgot-password') }}">Quên mật khẩu?</a>
    </div>
@endsection
