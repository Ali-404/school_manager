<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ------------------------------
    // SHOW LOGIN FORM
    // ------------------------------
    public function showLogin()
    {
        return view('auth.login');
    }
    public function showStudentLogin()
    {
        return view('auth.student-login')->name("student.login");
    }


    // ------------------------------
    // LOGIN
    // ------------------------------
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }


    // ------------------------------
    // SHOW REGISTER FORM
    // ------------------------------
    public function showRegister()
    {
        return view('auth.register'); // blade view
    }



    // ------------------------------
    // REGISTER
    // ------------------------------
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }


    // ------------------------------
    // LOGOUT
    // ------------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
