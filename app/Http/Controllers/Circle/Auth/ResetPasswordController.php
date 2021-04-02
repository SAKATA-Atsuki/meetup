<?php

namespace App\Http\Controllers\Circle\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\CirclePasswordResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::TOP;

    // フォーム表示
    public function showResetForm(Request $request, $token = null)
    {
        return view('circle.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // パスワードリセット処理
    public function reset(CirclePasswordResetPasswordRequest $request)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }

    // 資格情報
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_check', 'token'
        );
    }

    // リセットパスワード
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->save();

        event(new PasswordReset($user));

        $this->guard()->login($user);
    }

    // ブローカー
    public function broker()
    {
        return Password::broker('circles');
    }

    // ガード
    protected function guard()
    {
        return Auth::guard('circle');
    }
}
