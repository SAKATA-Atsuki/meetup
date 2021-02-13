<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
            if ($request->session()->exists('admin_message_search')) {
                $session_admin_message_search = $request->session()->get('admin_message_search');
            } else {
                $session_admin_message_search['id'] = '';
                $session_admin_message_search['thread_id'] = '';
                $session_admin_message_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_message_search');
            
            $session_admin_message_search['id'] = '';
            $session_admin_message_search['thread_id'] = '';
            $session_admin_message_search['free'] = '';
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
            $messages = Message::where('id', 'like', '%' . $session_admin_message_search['id'] . '%')
                                ->where('thread_id', 'like', '%' . $session_admin_message_search['thread_id'] . '%')
                                ->where('content', 'like', '%' . $session_admin_message_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $messages = Message::where('id', 'like', '%' . $session_admin_message_search['id'] . '%')
                                ->where('thread_id', 'like', '%' . $session_admin_message_search['thread_id'] . '%')
                                ->where('content', 'like', '%' . $session_admin_message_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.message.index', compact('session_admin_message_search', 'page', 'order', 'messages'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        $request->session()->put('admin_message_search', $data);
        $session_admin_message_search = $request->session()->get('admin_message_search');

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
            $messages = Message::where('id', 'like', '%' . $session_admin_message_search['id'] . '%')
                                ->where('thread_id', 'like', '%' . $session_admin_message_search['thread_id'] . '%')
                                ->where('content', 'like', '%' . $session_admin_message_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $messages = Message::where('id', 'like', '%' . $session_admin_message_search['id'] . '%')
                                ->where('thread_id', 'like', '%' . $session_admin_message_search['thread_id'] . '%')
                                ->where('content', 'like', '%' . $session_admin_message_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.message.index', compact('session_admin_message_search', 'page', 'order', 'messages'));
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $message = Message::find($request->id);

        return view('admin.message.detail', compact('page', 'order', 'message'));
    }

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.message.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        $order = $request->order;

        Message::find($request->id)->delete();

        return redirect()->route('admin.message', ['order' => $order]);
    }
}
