<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function process(ResetPasswordRequest $request)
    {
        $password_reset = $this->getPasswordResetTableRow($request)->first();
        if (!is_null($password_reset)) {
            $this->changePassword($password_reset->email, $request);
            return redirect()->route('admin.login.index')->with([
                'notify' => config('message.changepassword_success'),
                'notify-type' => 'success'
            ]);
        } else {
            return back()->with([
                'notify' => config('message.resetpassword_error'),
                'notify-type' => 'danger'
            ]);
        }
    }

    private function getPasswordResetTableRow($request)
    {
        return DB::table('password_resets')
            ->where('token', $request->reset_token)
            ->select(['email']);
    }

    private function changePassword($email, $request)
    {
        $user = User::where('email', $email)->first();
        $user->update(['password' => $request->password]);
        $this->getPasswordResetTableRow($request)->delete();
    }
}
