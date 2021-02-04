<?php

namespace App\Http\Controllers\Circle\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Campus;
use App\Models\Circle;
use App\Models\Circle_subcategory;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\CircleRegisterRequest;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::TOP;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:circle');
    }

    // 新入生登録フォーム表示
    public function showRegistrationForm()
    {
        $campuses = Campus::all();
        $circle_subcategories = Circle_subcategory::where('circle_category_id', old('circle_category_id'))->get();

        return view('circle.auth.register', compact('campuses', 'circle_subcategories'));
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

    // 新入生登録フォーム確認
    public function register(CircleRegisterRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);
        $circle_subcategory = Circle_subcategory::find($data['circle_subcategory_id']);

        return view('circle.auth.check', compact('data', 'campus', 'circle_subcategory'));
    }

    // 新入生登録
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('circle.register')->withInput($request->all());
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

            $this->guard()->login($circle);

            return $this->registered($request, $circle)
                            ?: redirect($this->redirectPath());
        }
    }

    // ガード
    protected function guard()
    {
        return Auth::guard('circle');
    }
}
