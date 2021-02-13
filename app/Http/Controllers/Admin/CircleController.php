<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CircleRegisterRequest;
use App\Http\Requests\AdminCircleRequest;
use App\Models\Campus;
use App\Models\Circle_subcategory;
use App\Models\Circle;
use App\Models\Thread;
use App\Models\Message;
use App\Models\Favorite;
use Illuminate\Support\Facades\Hash;

class CircleController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
            if ($request->session()->exists('admin_circle_search')) {
                $session_admin_circle_search = $request->session()->get('admin_circle_search');
            } else {
                $session_admin_circle_search['id'] = '';
                $session_admin_circle_search['campus_id'] = '';
                $session_admin_circle_search['circle_category_id'] = '';
                $session_admin_circle_search['circle_subcategory_id'] = '';
                $session_admin_circle_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_circle_search');
            
            $session_admin_circle_search['id'] = '';
            $session_admin_circle_search['campus_id'] = '';
            $session_admin_circle_search['circle_category_id'] = '';
            $session_admin_circle_search['circle_subcategory_id'] = '';
            $session_admin_circle_search['free'] = '';
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

        $campuses = Campus::all();
        $circle_subcategories = Circle_subcategory::where('circle_category_id', $session_admin_circle_search['circle_category_id'])->get();

        if ($order == 1) {
            $circles = Circle::where('id', 'like', '%' . $session_admin_circle_search['id'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_circle_search['campus_id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_circle_search['circle_category_id'] . '%')
                                ->where('circle_subcategory_id', 'like', '%' . $session_admin_circle_search['circle_subcategory_id'] . '%')
                                ->where(function($query) use($session_admin_circle_search) {
                                    $query->where('name', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_circle_search['free'] . '%');
                                })
                                ->simplePaginate(10);
        } else {
            $circles = Circle::where('id', 'like', '%' . $session_admin_circle_search['id'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_circle_search['campus_id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_circle_search['circle_category_id'] . '%')
                                ->where('circle_subcategory_id', 'like', '%' . $session_admin_circle_search['circle_subcategory_id'] . '%')
                                ->where(function($query) use($session_admin_circle_search) {
                                    $query->where('name', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_circle_search['free'] . '%');
                                })
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.circle.index', compact('session_admin_circle_search', 'page', 'order', 'campuses', 'circle_subcategories', 'circles'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        if (isset($data['circle_category_id'])) {
        } else {
            $data['circle_category_id'] = '';
        }

        $request->session()->put('admin_circle_search', $data);
        $session_admin_circle_search = $request->session()->get('admin_circle_search');

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

        $campuses = Campus::all();
        $circle_subcategories = Circle_subcategory::where('circle_category_id', $session_admin_circle_search['circle_category_id'])->get();

        if ($order == 1) {
            $circles = Circle::where('id', 'like', '%' . $session_admin_circle_search['id'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_circle_search['campus_id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_circle_search['circle_category_id'] . '%')
                                ->where('circle_subcategory_id', 'like', '%' . $session_admin_circle_search['circle_subcategory_id'] . '%')
                                ->where(function($query) use($session_admin_circle_search) {
                                    $query->where('name', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_circle_search['free'] . '%');
                                })
                                ->simplePaginate(10);
        } else {
            $circles = Circle::where('id', 'like', '%' . $session_admin_circle_search['id'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_circle_search['campus_id'] . '%')
                                ->where('circle_category_id', 'like', '%' . $session_admin_circle_search['circle_category_id'] . '%')
                                ->where('circle_subcategory_id', 'like', '%' . $session_admin_circle_search['circle_subcategory_id'] . '%')
                                ->where(function($query) use($session_admin_circle_search) {
                                    $query->where('name', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_circle_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_circle_search['free'] . '%');
                                })
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.circle.index', compact('session_admin_circle_search', 'page', 'order', 'campuses', 'circle_subcategories', 'circles'));
    }

    // Ajax
    public function category(Request $request)
    {
        $circle_category_id = $request->circle_category_id;
        $circle_subcategories = Circle_subcategory::where('circle_category_id', $circle_category_id)->get();
        $circle_subcategory_list = array();

        foreach ($circle_subcategories as $circle_subcategory) {
            $circle_subcategory_list[$circle_subcategory->id] = $circle_subcategory->name;
        }

        // json形式で返す
        echo json_encode($circle_subcategory_list);
    }
    
    // 新規登録フォーム表示
    public function register(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $campuses = Campus::all();

        $circle_subcategories = Circle_subcategory::where('circle_category_id', old('circle_category_id'))->get();

        return view('admin.circle.register', compact('page', 'order', 'campuses', 'circle_subcategories'));
    }

    // 新規登録フォーム確認
    public function checkRegister(CircleRegisterRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);
        $circle_subcategory = Circle_subcategory::find($data['circle_subcategory_id']);

        return view('admin.circle.checkRegister', compact('data', 'campus', 'circle_subcategory'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.circle.register', ['page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $circle = new Circle;
            $circle->name = $request->name;
            $circle->campus_id = $request->campus_id;
            $circle->circle_category_id = $request->circle_category_id;
            $circle->circle_subcategory_id = $request->circle_subcategory_id;
            $circle->email = $request->email;
            $circle->password = Hash::make($request->password);
            $circle->introduction = $request->introduction;
            $circle->save();

            return redirect()->route('admin.circle', ['page' => $request->page, 'order' => $request->order]);
        }
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $circle = Circle::find($request->id);

        return view('admin.circle.detail', compact('page', 'order', 'circle'));
    }

    // 編集フォーム表示
    public function edit(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $circle = Circle::find($request->id);

        $campuses = Campus::all();

        if (old('circle_subcategory_id') == null) {
            $circle_subcategories = Circle_subcategory::where('circle_category_id', $circle->circle_category_id)->get();
        } else {
            $circle_subcategories = Circle_subcategory::where('circle_category_id', old('circle_category_id'))->get();
        }

        return view('admin.circle.edit', compact('page', 'order', 'circle', 'campuses', 'circle_subcategories'));
    }

    // 編集フォーム確認
    public function checkEdit(AdminCircleRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);
        $circle_subcategory = Circle_subcategory::find($data['circle_subcategory_id']);

        return view('admin.circle.checkEdit', compact('data', 'campus', 'circle_subcategory'));
    }

    // 編集処理
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.circle.edit', ['id' => $request->id, 'page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $circle = Circle::find($request->id);
            $circle->name = $request->name;
            $circle->campus_id = $request->campus_id;
            $circle->circle_category_id = $request->circle_category_id;
            $circle->circle_subcategory_id = $request->circle_subcategory_id;
            $circle->email = $request->email;
            if ($request->password != '') {
                $circle->password = Hash::make($request->password);
            }
            $circle->introduction = $request->introduction;
            $circle->save();

            return redirect()->route('admin.circle', ['page' => $request->page, 'order' => $request->order]);
        }
    }    

    // 削除確認
    public function getDelete(Request $request)
    {
        $data = $request->all();

        return view('admin.circle.delete', compact('data'));
    }

    // 削除処理
    public function postDelete(Request $request)
    {
        $order = $request->order;

        Circle::find($request->id)->delete();
        Thread::where('circle_id', $request->id)->delete();
        Message::where('circle_id', $request->id)->delete();
        Favorite::where('circle_id', $request->id)->delete();

        return redirect()->route('admin.circle', ['order' => $order]);
    }
}
