<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CircleMypagePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    // パスワード変更フォーム表示
    public function index(Request $request)
    {
        return view('circle.mypage.password');
    }

    // パスワード変更
    public function update(CircleMypagePasswordRequest $request)
    {
        $circle = Auth::guard('circle')->user();
        $circle->password = Hash::make($request->password);
        $circle->save();

        return redirect()->route('circle.mypage');
    }
}
