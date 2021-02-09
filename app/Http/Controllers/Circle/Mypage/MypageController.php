<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    // マイページ表示
    public function index(Request $request)
    {
        $circle = Circle::find($request->id);

        return view('circle.mypage.index', compact('circle'));        
    }
}
