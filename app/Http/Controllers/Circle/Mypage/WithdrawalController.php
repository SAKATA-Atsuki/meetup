<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Thread;
use App\Models\Message;
use App\Models\Favorite;

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
        Thread::where('circle_id', Auth::guard('circle')->user()->id)->delete();
        Message::where('circle_id', Auth::guard('circle')->user()->id)->delete();
        Favorite::where('circle_id', Auth::guard('circle')->user()->id)->delete();

        return redirect()->route('top');
    }
}
