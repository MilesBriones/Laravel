<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Make sure you have a login view
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // If credentials are correct, redirect to intended page or dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // If login failed, return with error message
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
    }

    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect()->route('login');
    }
}
