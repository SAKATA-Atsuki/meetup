<?php

namespace App\Http\Controllers\Circle\Mypage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CircleMypageProfileRequest;
use App\Models\Campus;
use App\Models\Circle_subcategory;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // プロフィール変更フォーム表示
    public function index(Request $request)
    {
        $campuses = Campus::all();

        if (old('circle_subcategory_id') == null) {
            $circle_subcategories = Circle_subcategory::where('circle_category_id', Auth::guard('circle')->user()->circle_category_id)->get();
        } else {
            $circle_subcategories = Circle_subcategory::where('circle_category_id', old('circle_category_id'))->get();
        }

        return view('circle.mypage.profile', compact('campuses', 'circle_subcategories'));        
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
    
    // プロフィール変更フォーム確認
    public function check(CircleMypageProfileRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);
        $circle_subcategory = Circle_subcategory::find($data['circle_subcategory_id']);

        return view('circle.mypage.check', compact('data', 'campus', 'circle_subcategory'));    
    }

    // プロフィール変更
    public function update(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('circle.mypage.profile')->withInput($request->all());
        } else {
            $circle = Auth::guard('circle')->user();
            $circle->name = $request->name;
            $circle->campus_id = $request->campus_id;
            $circle->circle_category_id = $request->circle_category_id;
            $circle->circle_subcategory_id = $request->circle_subcategory_id;
            $circle->introduction = $request->introduction;
            $circle->save();

            return redirect()->route('circle.mypage');
        }
    }    
}
