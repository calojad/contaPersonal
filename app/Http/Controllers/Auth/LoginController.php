<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function comprobarCredenciales(Request $request){
        $user = $request->get('username');
        $pass = $request->get('password');
        $userdb = User::where('username',$user)->first();
        if($userdb===null){
            $message='Usuario no existe.<br> Por favor registrese.';
        }else if(Hash::check($pass,$userdb->password)) {
            $message='True';
        } else {
            $message='Contraseña incorrecta';
        }
        echo json_encode($message);
    }

    public function username()
    {
        return 'username';
    }
}
