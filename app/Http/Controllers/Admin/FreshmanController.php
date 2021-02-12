<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminSubcategoryRequest;
use App\Models\Campus;
use App\Models\Freshman;

class FreshmanController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('page')) {
            if ($request->session()->exists('admin_subcategory_search')) {
                $session_admin_subcategory_search = $request->session()->get('admin_subcategory_search');
            } else {
                $session_admin_subcategory_search['id'] = '';
                $session_admin_subcategory_search['circle_category_id'] = '';
                $session_admin_subcategory_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_subcategory_search');
            
            $session_admin_subcategory_search['id'] = '';
            $session_admin_subcategory_search['circle_category_id'] = '';
            $session_admin_subcategory_search['free'] = '';
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
            $subcategories = Circle_subcategory::where('id', 'like', '%' . $session_admin_subcategory_search['id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_subcategory_search['circle_category_id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_subcategory_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $subcategories = Circle_subcategory::where('id', 'like', '%' . $session_admin_subcategory_search['id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_subcategory_search['circle_category_id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_subcategory_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.freshman.index', compact('session_admin_subcategory_search', 'page', 'order', 'subcategories'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        if (isset($data['circle_category_id'])) {
        } else {
            $data['circle_category_id'] = '';
        }

        $request->session()->put('admin_subcategory_search', $data);
        $session_admin_subcategory_search = $request->session()->get('admin_subcategory_search');

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
            $subcategories = Circle_subcategory::where('id', 'like', '%' . $session_admin_subcategory_search['id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_subcategory_search['circle_category_id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_subcategory_search['free'] . '%')
                                ->simplePaginate(10);
        } else {
            $subcategories = Circle_subcategory::where('id', 'like', '%' . $session_admin_subcategory_search['id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_subcategory_search['circle_category_id'] . '%')
                                ->where('name', 'like', '%' . $session_admin_subcategory_search['free'] . '%')
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.freshman.index', compact('session_admin_subcategory_search', 'page', 'order', 'subcategories'));
    }

    // 新規登録フォーム表示
    public function register(Request $request)
    {
        $page = $request->page;

        return view('admin.freshman.register', compact('page'));
    }

    // 新規登録フォーム確認
    public function checkRegister(AdminSubcategoryRequest $request)
    {
        $data = $request->all();

        return view('admin.freshman.checkRegister', compact('data'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.freshman.register', ['page' => $request->page])->withInput($request->all());
        } else {
            $subcategory = new Circle_subcategory;
            $subcategory->circle_category_id = $request->circle_category_id;
            $subcategory->name = $request->name;
            $subcategory->save();

            return redirect()->route('admin.freshman', ['page' => $request->page]);
        }
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;

        $subcategory = Circle_subcategory::find($request->id);

        return view('admin.freshman.detail', compact('page', 'subcategory'));
    }

    // 編集フォーム表示
    public function edit(Request $request)
    {
        $page = $request->page;

        $subcategory = Circle_subcategory::find($request->id);

        return view('admin.freshman.edit', compact('page', 'subcategory'));
    }

    // 編集フォーム確認
    public function checkEdit(AdminSubcategoryRequest $request)
    {
        $data = $request->all();

        return view('admin.freshman.checkEdit', compact('data'));
    }

    // 編集処理
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.freshman.edit', ['id' => $request->id, 'page' => $request->page])->withInput($request->all());
        } else {
            $subcategory = Circle_subcategory::find($request->id);
            $subcategory->circle_category_id = $request->circle_category_id;
            $subcategory->name = $request->name;
            $subcategory->save();

            return redirect()->route('admin.freshman', ['page' => $request->page]);
        }
    }    

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.freshman.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        Circle_subcategory::find($request->id)->delete();

        return redirect()->route('admin.freshman');
    }
}
