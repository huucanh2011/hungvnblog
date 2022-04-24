@component('mail::message')
# Yêu cầu thay đổi mật khẩu

Nhấn vào nút bên dưới để thay đổi mật khẩu

@component('mail::button', [
    'url' => config('app.url') . config('app.response_reset_password_url') . $token,
    'color' => 'primary'
])
Đặt lại mật khẩu
@endcomponent

Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
