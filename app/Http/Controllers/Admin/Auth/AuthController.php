<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        // dd ($request->all());
        $credentials = $request->validated();
        $remember_me = $request->has('remember_me') ? true : false;
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], $remember_me)) {
            // dd ('ok');
            return redirect()->route('admin.index');
        } else {
            return back()->withInput()->with([
                'notify' => config('message.login_error'),
                'notify-type' => 'danger'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.index');
    }
}
