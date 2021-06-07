<?php

namespace App\Http\Controllers\backends\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
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

        $credentials = $request->only('name', 'password');
        $credentials['active_fg'] = 1;
        if (Auth::attempt($credentials)) {
            return redirect()->intended();
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

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }
}
