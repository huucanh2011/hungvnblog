<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Auth\UpdateInfoRequest;
use App\Http\Requests\Admin\Auth\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function updateInfo(UpdateInfoRequest $request)
    {
        $request->user()->update($request->validated());
        return back()->with(['notify' => config('message.changeinfo_success')]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $input = $request->validated();
        $user = $request->user();
        $current_password = $input['current_password'];
        $new_password = $input['new_password'];

        if (Hash::check($new_password, $user->password)) {
            return back()->with([
                'notify' => config('message.changepassword_error1'),
                'notify-type' => 'danger'
            ]);
        }

        if (!Hash::check($current_password, $user->password)) {
            return back()->with([
                'notify' => config('message.changepassword_error2'),
                'notify-type' => 'danger'
            ]);
        }

        $user->update(['password' => $new_password]);

        return back()->with([
            'notify' => config('message.changepassword_success'),
        ]);
    }
}
