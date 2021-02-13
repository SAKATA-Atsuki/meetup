<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
            if ($request->session()->exists('admin_favorite_search')) {
                $session_admin_favorite_search = $request->session()->get('admin_favorite_search');
            } else {
                $session_admin_favorite_search['id'] = '';
                $session_admin_favorite_search['freshman_id'] = '';
                $session_admin_favorite_search['circle_id'] = '';
            }
        } else {
            $request->session()->forget('admin_favorite_search');
            
            $session_admin_favorite_search['id'] = '';
            $session_admin_favorite_search['freshman_id'] = '';
            $session_admin_favorite_search['circle_id'] = '';
        }

        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        if (isset($request->order)) {
            $order = $request->order;
        } else {
            $order = 1;
        }

        if ($order == 1) {
            $favorites = Favorite::where('id', 'like', '%' . $session_admin_favorite_search['id'] . '%')
                                ->where('freshman_id', 'like', '%' . $session_admin_favorite_search['freshman_id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_favorite_search['circle_id'] . '%')
                                ->simplePaginate(10);
        } else {
            $favorites = Favorite::where('id', 'like', '%' . $session_admin_favorite_search['id'] . '%')
                                ->where('freshman_id', 'like', '%' . $session_admin_favorite_search['freshman_id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_favorite_search['circle_id'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.favorite.index', compact('session_admin_favorite_search', 'page', 'order', 'favorites'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        $request->session()->put('admin_favorite_search', $data);
        $session_admin_favorite_search = $request->session()->get('admin_favorite_search');

        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        if (isset($request->order)) {
            $order = $request->order;
        } else {
            $order = 1;
        }

        if ($order == 1) {
            $favorites = Favorite::where('id', 'like', '%' . $session_admin_favorite_search['id'] . '%')
                                ->where('freshman_id', 'like', '%' . $session_admin_favorite_search['freshman_id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_favorite_search['circle_id'] . '%')
                                ->simplePaginate(10);
        } else {
            $favorites = Favorite::where('id', 'like', '%' . $session_admin_favorite_search['id'] . '%')
                                ->where('freshman_id', 'like', '%' . $session_admin_favorite_search['freshman_id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_favorite_search['circle_id'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.favorite.index', compact('session_admin_favorite_search', 'page', 'order', 'favorites'));
    }

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.favorite.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        $order = $request->order;

        Favorite::find($request->id)->delete();

        return redirect()->route('admin.favorite', ['order' => $order]);
    }
}
