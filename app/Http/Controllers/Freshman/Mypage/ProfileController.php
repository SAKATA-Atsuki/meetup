<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanMypageProfileRequest;
use App\Models\Freshman;
use App\Models\Campus;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // プロフィール変更フォーム表示
    public function index(Request $request)
    {
        $freshman = Freshman::find(Auth::guard('freshman')->user()->id);
        $campuses = Campus::all();

        return view('freshman.mypage.profile', compact('freshman', 'campuses'));        
    }

    // プロフィール変更フォーム確認
    public function check(FreshmanMypageProfileRequest $request)
    {
        if ($request->has('back')) {
            return redirect()->route('freshman.mypage');
        } else {
            $data = $request->all();
            $campus = Campus::find($data['campus_id']);
    
            return view('freshman.mypage.profileCheck', compact('data', 'campus'));    
        }
    }

    // プロフィール変更登録
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('freshman.mypage.profile')->withInput($request->all());
        } else {
            $freshman = Freshman::find(Auth::guard('freshman')->user()->id);
            $freshman->name_sei = $request->name_sei;
            $freshman->name_mei = $request->name_mei;
            $freshman->nickname = $request->nickname;
            $freshman->gender = $request->gender;
            $freshman->campus_id = $request->campus_id;
            $freshman->introduction = $request->introduction;
            $freshman->save();

            return redirect()->route('freshman.mypage');
        }
    }    
}
