<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        return view('auth.student-login');
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

        // Redirect based on role (default to manager dashboard)
        $user = Auth::user();
        if ($user && isset($user->role) && $user->role === 'student') {
            return redirect()->intended(route('student.modules'));
        }

        return redirect()->intended(route('manager.dashboard'));
    }

    // Student-specific login endpoint (separate form)
    public function loginStudent(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user && isset($user->role) && $user->role !== 'student') {
            Auth::logout();
            return back()->withErrors(['email' => 'Not a student account']);
        }

        return redirect()->intended(route('student.modules'));
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
            'role' => 'manager', // Registration creates managers
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
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

    // ------------------------------
    // MANAGER: Update password
    // ------------------------------
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
