<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページ表示
    public function index(Request $request)
    {
        return view('circle.mypage.index');        
    }
}
