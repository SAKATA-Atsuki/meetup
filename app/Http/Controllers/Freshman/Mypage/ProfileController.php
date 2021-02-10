<?php

namespace App\Http\Controllers\Freshman\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanMypageProfileRequest;
use App\Models\Campus;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // プロフィール変更フォーム表示
    public function index(Request $request)
    {
        $campuses = Campus::all();

        return view('freshman.mypage.profile', compact('campuses'));        
    }

    // プロフィール変更フォーム確認
    public function check(FreshmanMypageProfileRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);

        return view('freshman.mypage.check', compact('data', 'campus'));    
    }

    // プロフィール変更
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('freshman.mypage.profile')->withInput($request->all());
        } else {
            $freshman = Auth::guard('freshman')->user();
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
