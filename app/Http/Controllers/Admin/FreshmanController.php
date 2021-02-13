<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanRegisterRequest;
use App\Http\Requests\AdminFreshmanRequest;
use App\Models\Campus;
use App\Models\Freshman;
use Illuminate\Support\Facades\Hash;

class FreshmanController extends Controller
{
    // 一覧表示
    public function index(Request $request)
    {
        if ($request->has('order')) {
            if ($request->session()->exists('admin_freshman_search')) {
                $session_admin_freshman_search = $request->session()->get('admin_freshman_search');
            } else {
                $session_admin_freshman_search['id'] = '';
                $session_admin_freshman_search['gender'] = '';
                $session_admin_freshman_search['campus_id'] = '';
                $session_admin_freshman_search['free'] = '';
            }
        } else {
            $request->session()->forget('admin_freshman_search');
            
            $session_admin_freshman_search['id'] = '';
            $session_admin_freshman_search['gender'] = '';
            $session_admin_freshman_search['campus_id'] = '';
            $session_admin_freshman_search['free'] = '';
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

        if ($order == 1) {
            $freshmen = Freshman::where('id', 'like', '%' . $session_admin_freshman_search['id'] . '%')
                                ->where('gender', 'like', '%' . $session_admin_freshman_search['gender'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_freshman_search['campus_id'] . '%')
                                ->where(function($query) use($session_admin_freshman_search) {
                                    $query->where('name_sei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('name_mei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('nickname', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_freshman_search['free'] . '%');
                                })
                                ->simplePaginate(10);
        } else {
            $freshmen = Freshman::where('id', 'like', '%' . $session_admin_freshman_search['id'] . '%')
                                ->where('gender', 'like', '%' . $session_admin_freshman_search['gender'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_freshman_search['campus_id'] . '%')
                                ->where(function($query) use($session_admin_freshman_search) {
                                    $query->where('name_sei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('name_mei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('nickname', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_freshman_search['free'] . '%');
                                })
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.freshman.index', compact('session_admin_freshman_search', 'page', 'order', 'campuses', 'freshmen'));
    }

    // 検索結果表示
    public function search(Request $request)
    {
        $data = $request->all();

        if (isset($data['gender'])) {
        } else {
            $data['gender'] = '';
        }

        $request->session()->put('admin_freshman_search', $data);
        $session_admin_freshman_search = $request->session()->get('admin_freshman_search');

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

        if ($order == 1) {
            $freshmen = Freshman::where('id', 'like', '%' . $session_admin_freshman_search['id'] . '%')
                                ->where('gender', 'like', '%' . $session_admin_freshman_search['gender'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_freshman_search['campus_id'] . '%')
                                ->where(function($query) use($session_admin_freshman_search) {
                                    $query->where('name_sei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('name_mei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('nickname', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_freshman_search['free'] . '%');
                                })
                                ->simplePaginate(10);
        } else {
            $freshmen = Freshman::where('id', 'like', '%' . $session_admin_freshman_search['id'] . '%')
                                ->where('gender', 'like', '%' . $session_admin_freshman_search['gender'] . '%')
                                ->where('campus_id', 'like', '%' . $session_admin_freshman_search['campus_id'] . '%')
                                ->where(function($query) use($session_admin_freshman_search) {
                                    $query->where('name_sei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('name_mei', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('nickname', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('email', 'like', '%' . $session_admin_freshman_search['free'] . '%')
                                            ->orWhere('introduction', 'like', '%' . $session_admin_freshman_search['free'] . '%');
                                })
                                ->orderBy('id', 'desc')
                                ->simplePaginate(10);
        }

        return view('admin.freshman.index', compact('session_admin_freshman_search', 'page', 'order', 'campuses', 'freshmen'));
    }

    // 新規登録フォーム表示
    public function register(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $campuses = Campus::all();

        return view('admin.freshman.register', compact('page', 'order', 'campuses'));
    }

    // 新規登録フォーム確認
    public function checkRegister(FreshmanRegisterRequest $request)
    {
        $data = $request->all();

        $campus = Campus::find($data['campus_id']);

        return view('admin.freshman.checkRegister', compact('data', 'campus'));
    }

    // 新規登録処理
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.freshman.register', ['page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $freshman = new Freshman;
            $freshman->name_sei = $request->name_sei;
            $freshman->name_mei = $request->name_mei;
            $freshman->nickname = $request->nickname;
            $freshman->gender = $request->gender;
            $freshman->campus_id = $request->campus_id;
            $freshman->email = $request->email;
            $freshman->password = Hash::make($request->password);
            $freshman->introduction = $request->introduction;
            $freshman->save();

            return redirect()->route('admin.freshman', ['page' => $request->page, 'order' => $request->order]);
        }
    }

    // 詳細表示
    public function detail(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $freshman = Freshman::find($request->id);

        return view('admin.freshman.detail', compact('page', 'order', 'freshman'));
    }

    // 編集フォーム表示
    public function edit(Request $request)
    {
        $page = $request->page;
        $order = $request->order;

        $campuses = Campus::all();

        $freshman = Freshman::find($request->id);

        return view('admin.freshman.edit', compact('page', 'order', 'campuses', 'freshman'));
    }

    // 編集フォーム確認
    public function checkEdit(AdminFreshmanRequest $request)
    {
        $data = $request->all();

        $campus = Campus::find($data['campus_id']);

        return view('admin.freshman.checkEdit', compact('data', 'campus'));
    }

    // 編集処理
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('admin.freshman.edit', ['id' => $request->id, 'page' => $request->page, 'order' => $request->order])->withInput($request->all());
        } else {
            $freshman = Freshman::find($request->id);
            $freshman->name_sei = $request->name_sei;
            $freshman->name_mei = $request->name_mei;
            $freshman->nickname = $request->nickname;
            $freshman->gender = $request->gender;
            $freshman->campus_id = $request->campus_id;
            $freshman->email = $request->email;
            if ($request->password != '') {
                $freshman->password = Hash::make($request->password);
            }
            $freshman->introduction = $request->introduction;
            $freshman->save();

            return redirect()->route('admin.freshman', ['page' => $request->page, 'order' => $request->order]);
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
        $order = $request->order;

        Freshman::find($request->id)->delete();

        return redirect()->route('admin.freshman', ['order' => $order]);
    }
}
