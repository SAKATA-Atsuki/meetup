<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    // 退会確認画面表示
    public function index(Request $request)
    {
        return view('circle.mypage.withdrawal');
    }

    // 退会処理
    public function delete(Request $request)
    {
        Auth::guard('circle')->user()->delete();

        return redirect()->route('top');
    }
}
