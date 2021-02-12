<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminSubcategoryRequest;
use App\Models\Circle_subcategory;

class SubcategoryController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
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

        return view('admin.subcategory.index', compact('session_admin_subcategory_search', 'page', 'order', 'subcategories'));
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

        return view('admin.subcategory.index', compact('session_admin_subcategory_search', 'page', 'order', 'subcategories'));
    }

    // 新規登録フォーム表示
    public function register(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        return view('admin.subcategory.register', compact('page', 'order'));
    }

    // 新規登録フォーム確認
    public function checkRegister(AdminSubcategoryRequest $request)
    {
        $data = $request->all();

        return view('admin.subcategory.checkRegister', compact('data'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.subcategory.register', ['page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $subcategory = new Circle_subcategory;
            $subcategory->circle_category_id = $request->circle_category_id;
            $subcategory->name = $request->name;
            $subcategory->save();

            return redirect()->route('admin.subcategory', ['page' => $request->page, 'order' => $request->order]);
        }
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $subcategory = Circle_subcategory::find($request->id);

        return view('admin.subcategory.detail', compact('page', 'order', 'subcategory'));
    }

    // 編集フォーム表示
    public function edit(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $subcategory = Circle_subcategory::find($request->id);

        return view('admin.subcategory.edit', compact('page', 'order', 'subcategory'));
    }

    // 編集フォーム確認
    public function checkEdit(AdminSubcategoryRequest $request)
    {
        $data = $request->all();

        return view('admin.subcategory.checkEdit', compact('data'));
    }

    // 編集処理
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.subcategory.edit', ['id' => $request->id, 'page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $subcategory = Circle_subcategory::find($request->id);
            $subcategory->circle_category_id = $request->circle_category_id;
            $subcategory->name = $request->name;
            $subcategory->save();

            return redirect()->route('admin.subcategory', ['page' => $request->page, 'order' => $request->order]);
        }
    }    

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.subcategory.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        $order = $request->order;

        Circle_subcategory::find($request->id)->delete();

        return redirect()->route('admin.subcategory', ['order' => $order]);
    }
}
