<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanMypageEmailRequest;
use App\Http\Requests\FreshmanMypageEmailAuthRequest;
use App\Models\Freshman;
use App\Models\Circle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreshmanEmailEditNotification;

class EmailController extends Controller
{
    // メールアドレス変更フォーム表示
    public function index(Request $request)
    {
        return view('freshman.mypage.email');
    }

    // 認証メール送信
    public function send(FreshmanMypageEmailRequest $request)
    {
        do {
            $auth_code = (int) str_pad(mt_Rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $freshmen = Freshman::where('auth_code', $auth_code)->get();
            $circles = Circle::where('auth_code', $auth_code)->get();    
        } while (count($freshmen) != 0 || count($circles) != 0);

        Mail::to($request->email)->send(new FreshmanEmailEditNotification($auth_code));

        $freshman = Auth::guard('freshman')->user();
        $freshman->auth_code = $auth_code;
        $freshman->save();

        return redirect()->route('freshman.mypage.email.auth', ['email' => $request->email]);
    }

    // 認証コード確認
    public function auth(Request $request)
    {
        $email = $request->email;

        return view('freshman.mypage.auth', compact('email'));
    }

    // メールアドレス変更
    public function update(FreshmanMypageEmailAuthRequest $request)
    {
        $freshman = Auth::guard('freshman')->user();
        $freshman->email = $request->email;
        $freshman->save();

        return redirect()->route('freshman.mypage');
    }
}
