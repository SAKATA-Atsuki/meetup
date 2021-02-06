<?php

namespace App\Http\Controllers\Circle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRegisterRequest;
use App\Http\Requests\MessageRegisterRequest;
use App\Models\Circle;
use App\Models\Favorite;
use App\Models\Thread;
use App\Models\Freshman;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class CircleThreadController extends Controller
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

        if (isset($data['title'])) {
        } else {
            $data['title'] = '';
        }

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
    public function threadStore(ThreadRegisterRequest $request)
    {
        $thread = new Thread;
        if (Auth::guard('freshman')->check()) {
            $thread->freshman_id = Auth::guard('freshman')->user()->id;
        }
        $thread->circle_id = $request->id;
        $thread->title = $request->title;
        $thread->save();

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg]);
    }

    // スレッド削除
    public function threadDelete(Request $request)
    {
        Thread::find($request->thread_id)->delete();

        return redirect()->route('circle.thread', ['id' => $request->id, 'pg' => $request->pg]);
    }
    
    // 新入生詳細表示
    public function threadFreshman(Request $request)
    {
        $id = $request->id;
        $pg = $request->pg;
        $page = $request->page;

        $freshman = Freshman::find($request->freshman_id);

        return view('freshman.indexThread', compact('id', 'pg', 'page', 'freshman'));
    }

    // スレッド詳細表示
    public function message(Request $request)
    {
        $pg = $request->pg;
        $page = $request->page;

        $circle = Circle::find($request->id);

        $thread = Thread::find($request->thread_id);

        $messages = Message::where('thread_id', $request->thread_id)->withTrashed()->get();

        if (Auth::guard('freshman')->check()) {
            $favorite = Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                                ->where('circle_id', $request->id)
                                ->get();

            return view('circle.thread.message', compact('pg', 'page', 'circle', 'thread', 'messages', 'favorite'));
        } else {
            return view('circle.thread.message', compact('pg', 'page', 'circle', 'thread', 'messages'));
        }
    }

    // お気に入り処理
    public function messageFavorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }

    // お気に入り解除処理
    public function messageUnfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }        

    // メッセージ登録
    public function messageStore(MessageRegisterRequest $request)
    {
        $message = new Message;
        $message->thread_id = $request->thread_id;
        if (Auth::guard('freshman')->check()) {
            $message->freshman_id = Auth::guard('freshman')->user()->id;
        }
        $message->circle_id = $request->id;
        $message->content = $request->content;
        $message->save();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }    

    // メッセージ削除
    public function messageDelete(Request $request)
    {
        Message::find($request->message_id)->delete();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }

    // 新入生詳細表示
    public function messageFreshman(Request $request)
    {
        $id = $request->id;
        $pg = $request->pg;
        $thread_id = $request->thread_id;
        $page = $request->page;

        $freshman = Freshman::find($request->freshman_id);

        return view('freshman.indexMessage', compact('id', 'pg', 'thread_id', 'page', 'freshman'));
    }    
}
