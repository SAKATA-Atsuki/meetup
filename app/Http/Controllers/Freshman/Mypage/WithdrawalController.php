<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class WithdrawalController extends Controller
{
    // 退会確認画面表示
    public function index(Request $request)
    {
        return view('freshman.mypage.withdrawal');
    }

    // 退会処理
    public function delete(Request $request)
    {
        Auth::guard('freshman')->user()->delete();
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)->delete();

        return redirect()->route('top');
    }
}
