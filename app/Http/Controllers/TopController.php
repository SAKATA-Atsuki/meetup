<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Circle_subcategory;
use App\Models\Circle;

class TopController extends Controller
{
    // トップ画面表示
    public function index(Request $request)
    {
        $data = $request->all();

        if (isset($data['name'])) {
        } else {
            $data['name'] = '';
        }
        if (isset($data['campus_id'])) {
        } else {
            $data['campus_id'] = '';
        }
        if (isset($data['circle_category_id'])) {
        } else {
            $data['circle_category_id'] = '';
        }
        if (isset($data['circle_subcategory_id'])) {
        } else {
            $data['circle_subcategory_id'] = '';
        }

        $campuses = Campus::all();
        $circle_subcategories = Circle_subcategory::where('circle_category_id', $data['circle_category_id'])->get();

        $circles = Circle::where('name', 'like', '%' . $data['name'] . '%')
                            ->where('campus_id', 'like', '%' . $data['campus_id'] . '%')
                            ->where('circle_category_id', 'like', '%' . $data['circle_category_id'] . '%')
                            ->where('circle_subcategory_id', 'like', '%' . $data['circle_subcategory_id'] . '%')
                            ->orderBy('updated_at', 'desc')
                            ->simplePaginate(10);

        return view('index', compact('data', 'campuses', 'circle_subcategories', 'circles'));
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
}
