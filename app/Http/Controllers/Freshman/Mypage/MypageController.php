<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Freshman;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページ表示
    public function index(Request $request)
    {
        return view('freshman.mypage.index');        
    }
}
