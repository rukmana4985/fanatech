<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{


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
    public function showLoginForm() {

    	return view('auth.login');
    }
    public function login(Request $request) {

        $this->validateLogin($request);

        $is_remember = $request->input('is_remember') ? 'remember' : '';

    	if (Auth::attempt($this->credentials($request), $is_remember)) {
                return redirect()->intended($this->redirectTo());
    	}
        toast()->error('Username dan password tidak ditemukan', "Login");
        return redirect()->back();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }
    public function redirectTo() {
    	return '/home';
    }

    public function logout() {
        session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
