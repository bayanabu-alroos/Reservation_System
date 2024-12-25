<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $input= $request ->all();
        $this->validate($request,[
            'email' =>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt(array('email'=>$input['email'],'password'=>$input['password']))){
            if(Auth::user()->type == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            else {
                return redirect()->route('dashboard');
            }
        }
        else{
            return redirect()->route('login')->with('error', 'email or password is incorrect .');
        }
    }
}
