<?php

namespace App\Http\Controllers\Circle\Thread;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRegisterRequest;
use App\Models\Circle;
use App\Models\Favorite;
use App\Models\Thread;
use App\Models\Freshman;
use App\Models\Message;
use App\Models\Reject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreshmanCreateThreadNotification;

class ThreadController extends Controller
{
    // スレッド一覧表示
    public function index(Request $request)
    {
        $pg = $request->pg;

        $circle = Circle::find($request->id);

        if ($request->has('page')) {
            if ($request->session()->exists('circle_thread_search')) {
                $session_circle_thread_search = $request->session()->get('circle_thread_search');
            } else {
                $session_circle_thread_search['title'] = '';
            }
        } else {
            $request->session()->forget('circle_thread_search');
            
            $session_circle_thread_search['title'] = '';
        }

        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        $threads = Thread::where('circle_id', $request->id)
                            ->where('title', 'like', '%' . $session_circle_thread_search['title'] . '%')
                            ->orderBy('updated_at', 'desc')
                            ->simplePaginate(10);

        if (Auth::guard('freshman')->check()) {
            $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->where('circle_id', $request->id)
                                ->get();

            return view('circle.thread.index', compact('pg', 'circle', 'session_circle_thread_search', 'page', 'threads', 'favorite'));
        } else {
            return view('circle.thread.index', compact('pg', 'circle', 'session_circle_thread_search', 'page', 'threads'));
        }    
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $pg = $request->pg;

        $circle = Circle::find($request->id);

        $data = $request->all();

        $request->session()->put('circle_thread_search', $data);
        $session_circle_thread_search = $request->session()->get('circle_thread_search');

        if (isset($request->page)) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        $threads = Thread::where('circle_id', $request->id)
                            ->where('title', 'like', '%' . $session_circle_thread_search['title'] . '%')
                            ->orderBy('updated_at', 'desc')
                            ->simplePaginate(10);

        if (Auth::guard('freshman')->check()) {
            $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->where('circle_id', $request->id)
                                ->get();

            return view('circle.thread.index', compact('pg', 'circle', 'session_circle_thread_search', 'page', 'threads', 'favorite'));
        } else {
            return view('circle.thread.index', compact('pg', 'circle', 'session_circle_thread_search', 'page', 'threads'));
        }
    }    

    // お気に入り処理
    public function threadFavorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg, 'page' => $request->page]);
    }

    // お気に入り解除処理
    public function threadUnfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg, 'page' => $request->page]);
    }    

    // スレッド作成フォーム表示
    public function register(Request $request)
    {
        $pg = $request->pg;
        $page = $request->page;

        $circle = Circle::find($request->id);

        if (Auth::guard('freshman')->check()) {
            $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->where('circle_id', $request->id)
                                ->get();

            return view('circle.thread.register', compact('pg', 'page', 'circle', 'favorite'));
        } else {
            return view('circle.thread.register', compact('pg', 'page', 'circle'));
        }
    }

    // お気に入り処理
    public function registerFavorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('circle.thread.register', ['id' => $request->id, 'pg' => $request->pg, 'page' => $request->page]);
    }

    // お気に入り解除処理
    public function registerUnfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('circle.thread.register', ['id' => $request->id, 'pg' => $request->pg, 'page' => $request->page]);
    }        
    
    // スレッド登録
    public function store(ThreadRegisterRequest $request)
    {
        // 登録処理
        $thread = new Thread;
        if (Auth::guard('freshman')->check()) {
            $thread->freshman_id = Auth::guard('freshman')->user()->id;
        }
        $thread->circle_id = $request->id;
        $thread->title = $request->title;
        $thread->save();

        // 通知送信処理
        if (Auth::guard('freshman')->check()) {
            $circle = Circle::find($request->id);
            $reject = Reject::where('circle_id', $circle['id'])->get();
            if (count($reject) == 0) {
                Mail::to($circle['email'])->send(new FreshmanCreateThreadNotification(Auth::guard('freshman')->user()->nickname, $request->title));
            }
        }

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg]);
    }

    // スレッド削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('circle.thread.deleteThread', compact('data'));
    }

    // スレッド削除処理
    public function postDelete(Request $request)
    {
        Thread::find($request->thread_id)->delete();
        Message::where('thread_id', $request->thread_id)->delete();

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg]);
    }
    
    // 新入生詳細表示
    public function freshman(Request $request)
    {
        $id = $request->id;
        $pg = $request->pg;
        $page = $request->page;

        $freshman = Freshman::find($request->freshman_id);

        return view('freshman.indexThread', compact('id', 'pg', 'page', 'freshman'));
    }
}