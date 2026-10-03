<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\registerPostRequest;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('students.index');
        }

        return back()->withErrors([
            'email' => 'The email or password maybe wrong.',
        ]);
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function registerPost(registerPostRequest $request)
    {

        User::create($request->validated());

        return redirect()->route('students.index');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-view');
    }
}
