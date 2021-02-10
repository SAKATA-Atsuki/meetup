<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CircleMypageEmailRequest;
use App\Http\Requests\CircleMypageEmailAuthRequest;
use App\Models\Freshman;
use App\Models\Circle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CircleEmailEditNotification;

class EmailController extends Controller
{
    // メールアドレス変更フォーム表示
    public function index(Request $request)
    {
        return view('circle.mypage.email');
    }

    // 認証メール送信
    public function send(CircleMypageEmailRequest $request)
    {
        do {
            $auth_code = (int) str_pad(mt_Rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $freshmen = Freshman::where('auth_code', $auth_code)->get();
            $circles = Circle::where('auth_code', $auth_code)->get();    
        } while (count($freshmen) != 0 || count($circles) != 0);

        Mail::to($request->email)->send(new CircleEmailEditNotification($auth_code));

        $circle = Auth::guard('circle')->user();
        $circle->auth_code = $auth_code;
        $circle->save();

        return redirect()->route('circle.mypage.email.auth', ['email' => $request->email]);
    }

    // 認証コード確認
    public function auth(Request $request)
    {
        $email = $request->email;

        return view('circle.mypage.auth', compact('email'));
    }

    // メールアドレス変更
    public function update(CircleMypageEmailAuthRequest $request)
    {
        $circle = Auth::guard('circle')->user();
        $circle->email = $request->email;
        $circle->save();

        return redirect()->route('circle.mypage');
    }
}
