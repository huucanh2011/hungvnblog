<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function sendMail(ForgotPasswordRequest $request)
    {
        $user = $this->validateLoginId($request->validated());
        if (is_null($user)) {
            return back()->with([
                'notify' => config('message.login_id_notfound'),
                'notify-type' => 'danger'
            ]);
        }
        $this->send($user->email);
        return back()->with([
            'notify' => config('message.forgotpassword_success')
        ]);
    }

    private function validateLoginId($input)
    {
        return User::where('email', $input['email'])->first();
    }

    private function send($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }

    private function createToken($email)
    {
        $old_token = DB::table('password_resets')
            ->where('email', $email)
            ->first();
        if ($old_token) {
            return $old_token->token;
        }
        $token = Str::random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    private function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);
    }
}
