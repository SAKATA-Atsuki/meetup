<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Circle;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // サークル一覧表示
    public function index(Request $request)
    {
        $favorites = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->orderBy('created_at', 'desc')                        
                                ->get();

        return view('freshman.mypage.favorite', compact('favorites'));
    }

    // サークル詳細表示
    public function circle(Request $request)
    {
        $circle = Circle::find($request->id);

        $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                            ->where('circle_id', $request->id)
                            ->get();

        return view('freshman.mypage.circle', compact('circle', 'favorite'));
    }

    // お気に入り処理
    public function favorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('freshman.mypage.favorite.circle', ['id' => $request->id]);
    }

    // お気に入り解除処理
    public function unfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('freshman.mypage.favorite.circle', ['id' => $request->id]);
    }
}
