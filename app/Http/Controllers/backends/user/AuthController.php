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

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }else{
            return redirect()->back()->with('error', 'Username or Password is not correct');
        }
    }

    public function process_login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('name',$request->name)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('home');

        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
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
