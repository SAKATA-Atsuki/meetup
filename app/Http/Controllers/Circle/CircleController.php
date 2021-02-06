<?php

namespace App\Http\Controllers\Circle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class CircleController extends Controller
{
    // サークル詳細表示
    public function index(Request $request)
    {
        $pg = $request->pg;

        $circle = Circle::find($request->id);

        if (Auth::guard('freshman')->check()) {
            $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->where('circle_id', $request->id)
                                ->get();

            return view('circle.index', compact('pg', 'circle', 'favorite'));
        } else {
            return view('circle.index', compact('pg', 'circle'));
        }
    }

    // お気に入り処理
    public function favorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('circle', ['id' => $request->id, 'pg' => $request->pg]);
    }

    // お気に入り解除処理
    public function unfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('circle', ['id' => $request->id, 'pg' => $request->pg]);
    }
}
