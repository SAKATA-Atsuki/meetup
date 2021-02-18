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
use App\Http\Requests\FreshmanEmailAuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreshmanRegisterNotification;

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

    // 認証メール送信
    public function send(Request $request)
    {
        if ($request->has('back')) {
            return redirect()->route('freshman.register')->withInput($request->all());
        } else {
            $auth_code = (int) str_pad(mt_Rand(0, 999999), 6, '0', STR_PAD_LEFT);

            Mail::to($request->email)->send(new FreshmanRegisterNotification($auth_code));
    
            $data = $request->all();
            $data['auth_code'] = $auth_code;
            $request->session()->put('freshman_register', $data);
    
            return redirect()->route('freshman.register.auth');
        }
    }

    // 認証コード確認
    public function auth(Request $request)
    {
        return view('freshman.auth.auth');
    }

    // 新入生登録
    public function store(FreshmanEmailAuthRequest $request)
    {
        $session_freshman_register = $request->session()->get('freshman_register');

        if ($request->auth_code == $session_freshman_register['auth_code']) {
            $freshman = new Freshman;
            $freshman->name_sei = $session_freshman_register['name_sei'];
            $freshman->name_mei = $session_freshman_register['name_mei'];
            $freshman->nickname = $session_freshman_register['nickname'];
            $freshman->gender = $session_freshman_register['gender'];
            $freshman->campus_id = $session_freshman_register['campus_id'];
            $freshman->email = $session_freshman_register['email'];
            $freshman->password = Hash::make($session_freshman_register['password']);
            $freshman->introduction = $session_freshman_register['introduction'];
            $freshman->save();
    
            $request->session()->forget('freshman_register');
    
            $this->guard()->login($freshman);
    
            return $this->registered($request, $freshman)
                            ?: redirect($this->redirectPath());    
        } else {
            $errors = ['auth_code' => '※認証コードが正しくありません'];
            
            return redirect()->route('freshman.register.auth')->withInput()->withErrors($errors);
        }
    }

    // ガード
    protected function guard()
    {
        return Auth::guard('freshman');
    }
}
