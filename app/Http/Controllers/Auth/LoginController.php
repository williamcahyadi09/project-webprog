<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //untuk melakukan login dengan pilihan remember atau tidak
    //jika login berhasil, akan diredirect ke home
    //jika login gagal, akan kembali dan muncul popup gagal
    public function loginWithRemember(Request $request){
        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember = (!empty($request->remember))? true : false;
        if(Auth::attempt($credential,$remember)){
            return redirect()->route('home');
        }
        return redirect('login')->with('failed','Email or Password is incorrect');
    }
}
