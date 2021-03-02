<?php

namespace App\Http\Controllers\Circle\Thread;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRegisterRequest;
use App\Models\Circle;
use App\Models\Favorite;
use App\Models\Thread;
use App\Models\Freshman;
use App\Models\Message;
use App\Models\Reject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreshmanCreateMessageNotification;

class MessageController extends Controller
{
    // スレッド詳細表示
    public function index(Request $request)
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
    public function favorite(Request $request)
    {
        $favorite = new Favorite;
        $favorite->freshman_id = Auth::guard('freshman')->user()->id;
        $favorite->circle_id = $request->id;
        $favorite->save();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }

    // お気に入り解除処理
    public function unfavorite(Request $request)
    {
        Favorite::where('freshman_id', Auth::guard('freshman')->user()->id)
                ->where('circle_id', $request->id)
                ->delete();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }        

    // メッセージ登録
    public function store(MessageRegisterRequest $request)
    {
        // 登録処理
        $message = new Message;
        $message->thread_id = $request->thread_id;
        if (Auth::guard('freshman')->check()) {
            $message->freshman_id = Auth::guard('freshman')->user()->id;
        }
        $message->circle_id = $request->id;
        $message->content = $request->content;
        $message->save();

        // 通知送信処理
        if (Auth::guard('freshman')->check()) {
            $circle = Circle::find($request->id);
            $reject = Reject::where('circle_id', $circle['id'])->get();
            if (count($reject) == 0) {
                Mail::to($circle['email'])->send(new FreshmanCreateMessageNotification(Auth::guard('freshman')->user()->nickname, $request->content));
            }
        }
        
        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }    

    // メッセージ削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('circle.thread.deleteMessage', compact('data'));
    }

    // メッセージ削除処理
    public function postDelete(Request $request)
    {
        Message::find($request->message_id)->delete();

        return redirect()->route('circle.thread.message', ['id' => $request->id, 'pg' => $request->pg, 'thread_id' => $request->thread_id, 'page' => $request->page]);
    }

    // 新入生詳細表示
    public function freshman(Request $request)
    {
        $id = $request->id;
        $pg = $request->pg;
        $thread_id = $request->thread_id;
        $page = $request->page;

        $freshman = Freshman::find($request->freshman_id);

        return view('freshman.indexMessage', compact('id', 'pg', 'thread_id', 'page', 'freshman'));
    }    
}