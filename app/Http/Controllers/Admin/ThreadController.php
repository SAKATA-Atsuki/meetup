<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;

class ThreadController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
            if ($request->session()->exists('admin_thread_search')) {
                $session_admin_thread_search = $request->session()->get('admin_thread_search');
            } else {
                $session_admin_thread_search['id'] = '';
                $session_admin_thread_search['circle_id'] = '';
                $session_admin_thread_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_thread_search');
            
            $session_admin_thread_search['id'] = '';
            $session_admin_thread_search['circle_id'] = '';
            $session_admin_thread_search['free'] = '';
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
            $threads = Thread::where('id', 'like', '%' . $session_admin_thread_search['id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_thread_search['circle_id'] . '%')
                                ->where('title', 'like', '%' . $session_admin_thread_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $threads = Thread::where('id', 'like', '%' . $session_admin_thread_search['id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_thread_search['circle_id'] . '%')
                                ->where('title', 'like', '%' . $session_admin_thread_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.thread.index', compact('session_admin_thread_search', 'page', 'order', 'threads'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        $request->session()->put('admin_thread_search', $data);
        $session_admin_thread_search = $request->session()->get('admin_thread_search');

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
            $threads = Thread::where('id', 'like', '%' . $session_admin_thread_search['id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_thread_search['circle_id'] . '%')
                                ->where('title', 'like', '%' . $session_admin_thread_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $threads = Thread::where('id', 'like', '%' . $session_admin_thread_search['id'] . '%')
                                ->where('circle_id', 'like', '%' . $session_admin_thread_search['circle_id'] . '%')
                                ->where('title', 'like', '%' . $session_admin_thread_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.thread.index', compact('session_admin_thread_search', 'page', 'order', 'threads'));
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $thread = Thread::find($request->id);

        return view('admin.thread.detail', compact('page', 'order', 'thread'));
    }

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.thread.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        $order = $request->order;

        Thread::find($request->id)->delete();

        return redirect()->route('admin.thread', ['order' => $order]);
    }
}
