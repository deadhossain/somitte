<?php

namespace App\Http\Controllers\backends\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('backends.pages.user.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = $request->only('name', 'password');
        $user['active_fg'] = 1;
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            $request->session()->put('user',$user);
            return redirect()->intended('/');
        }else{
            return back()->withErrors(['error'=>'Username or Password is not correct']);
        }
    }

    public function show_signup_form()
    {
        return view('backend.register');
    }

    public function process_signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        session()->flash('message', 'Your account is created');

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        $request->session()->regenerateToken();
        $request->session()->forget('user');
        return redirect()->route('login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
