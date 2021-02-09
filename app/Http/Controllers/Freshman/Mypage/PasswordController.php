<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanMypagePasswordRequest;
use App\Models\Freshman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // パスワード変更フォーム表示
    public function index(Request $request)
    {
        return view('freshman.mypage.password');
    }

    // パスワード変更
    public function update(FreshmanMypagePasswordRequest $request)
    {
        $freshman = Auth::guard('freshman')->user();
        $freshman->password = Hash::make($request->password);
        $freshman->save();

        return redirect()->route('freshman.mypage');
    }
}
