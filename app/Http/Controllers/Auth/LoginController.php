<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 登录
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $type = $request->input('type');
        if ($type == 1) {
            $user = User::firstOrCreate(['name' => '游客']);
            if ($this->guard()->attempt(['id' => $user->id, 'password' => '123123'], true)) {
                return $this->sendLoginResponse($request);
            }
        }

        if ($type == 2) {
            if ($this->guard()->attempt(['number' => $request->input('number'), 'password' => '123123'])) {
                return $this->sendLoginResponse($request);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }
}
