<?php

namespace App\Http\Controllers\Freshman\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Campus;
use App\Models\Freshman;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\FreshmanRegisterRequest;
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
        $this->middleware('guest:freshman');
    }

    // 新入生登録フォーム表示
    public function showRegistrationForm()
    {
        $campuses = Campus::all();

        return view('freshman.auth.register', compact('campuses'));
    }

    // 新入生登録フォーム確認
    public function register(FreshmanRegisterRequest $request)
    {
        $data = $request->all();
        $campus = Campus::find($data['campus_id']);

        return view('freshman.auth.check', compact('data', 'campus'));
    }

    // 新入生登録
    public function store(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('freshman.register')->withInput($request->all());
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

            $this->guard()->login($freshman);

            return $this->registered($request, $freshman)
                            ?: redirect($this->redirectPath());
        }
    }

    // ガード
    protected function guard()
    {
        return Auth::guard('freshman');
    }
}
