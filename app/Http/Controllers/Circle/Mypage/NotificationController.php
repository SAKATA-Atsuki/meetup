<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reject;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // メール通知設定表示
    public function index(Request $request)
    {
        $reject = Reject::where('circle_id', Auth::guard('circle')->user()->id)->get();

        return view('circle.mypage.notification', compact('reject'));
    }

    // 受信拒否処理
    public function reject(Request $request)
    {
        $reject = new Reject;
        $reject->circle_id = Auth::guard('circle')->user()->id;
        $reject->save();

        return redirect()->route('circle.mypage');
    }

    // 受信許可処理
    public function permit(Request $request)
    {
        Reject::where('circle_id', Auth::guard('circle')->user()->id)->delete();

        return redirect()->route('circle.mypage');
    }
}
