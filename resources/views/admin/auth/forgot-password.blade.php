@extends('admin.auth.layout')
@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-2">Bạn quên mật khẩu?</h1>
        <p class="mb-4">Bạn đừng lo. Chỉ cần nhập tên đăng nhập hoặc địa chỉ email của bạn
            dướiđây
            và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu của bạn!</p>
    </div>
    @include('share.alert')
    <form action="{{ route('admin.forgot-password.send') }}" method="POST" class="user" autocomplete="off">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control form-control-user @error('email') is-invalid @enderror"
                id="input_email" name="email" placeholder="Nhập email"
                value="{{ old('email') }}" autofocus>
            @error('email')
                <div id="input_emailFeedback" class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-user btn-block">
            Đặt lại mật khẩu
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('admin.login.index') }}">Quay lại đăng nhập!</a>
    </div>
@endsection
