<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminCampusRequest;
use App\Models\Campus;

class CampusController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('page')) {
            if ($request->session()->exists('admin_campus_search')) {
                $session_admin_campus_search = $request->session()->get('admin_campus_search');
            } else {
                $session_admin_campus_search['id'] = '';
                $session_admin_campus_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_campus_search');
            
            $session_admin_campus_search['id'] = '';
            $session_admin_campus_search['free'] = '';
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
            $campuses = Campus::where('id', 'like', '%' . $session_admin_campus_search['id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_campus_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $campuses = Campus::where('id', 'like', '%' . $session_admin_campus_search['id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_campus_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.campus.index', compact('session_admin_campus_search', 'page', 'order', 'campuses'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        $request->session()->put('admin_campus_search', $data);
        $session_admin_campus_search = $request->session()->get('admin_campus_search');

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
            $campuses = Campus::where('id', 'like', '%' . $session_admin_campus_search['id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_campus_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $campuses = Campus::where('id', 'like', '%' . $session_admin_campus_search['id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_campus_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.campus.index', compact('session_admin_campus_search', 'page', 'order', 'campuses'));
    }

    // 新規登録フォーム表示
    public function register(Request $request)
    {
        $page = $request->page;

        return view('admin.campus.register', compact('page'));
    }

    // 新規登録フォーム確認
    public function checkRegister(AdminCampusRequest $request)
    {
        $data = $request->all();

        return view('admin.campus.checkRegister', compact('data'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.campus.register', ['page' => $request->page])->withInput($request->all());
        } else {
            $campus = new Campus;
            $campus->name = $request->name;
            $campus->save();

            return redirect()->route('admin.campus', ['page' => $request->page]);
        }
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;

        $campus = Campus::find($request->id);

        return view('admin.campus.detail', compact('page', 'campus'));
    }

    // 編集フォーム表示
    public function edit(Request $request)
    {
        $page = $request->page;

        $campus = Campus::find($request->id);

        return view('admin.campus.edit', compact('page', 'campus'));
    }

    // 編集フォーム確認
    public function checkEdit(AdminCampusRequest $request)
    {
        $data = $request->all();

        return view('admin.campus.checkEdit', compact('data'));
    }

    // 編集処理
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.campus.edit', ['id' => $request->id, 'page' => $request->page])->withInput($request->all());
        } else {
            $campus = Campus::find($request->id);
            $campus->name = $request->name;
            $campus->save();

            return redirect()->route('admin.campus', ['page' => $request->page]);
        }
    }    

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.campus.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        Campus::find($request->id)->delete();

        return redirect()->route('admin.campus');
    }
}
