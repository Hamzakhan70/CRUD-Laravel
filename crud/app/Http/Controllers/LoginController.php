<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to authenticate the user
        $user = User::where('email', $validated['email'])->first();

        if ($user && Hash::check($validated['password'], $user->password)) {
            // Authentication passed
            Auth::login($user);

            // Check the user's role and redirect accordingly
            if ($user->role === 'admin') {
                // Redirect to admin dashboard
                return redirect()->route('admin.dashboard');
            } else if ($user->role === 'user') {
                // Redirect to user dashboard
                return redirect()->route('user.dashboard');
            } else {
                // Handle case where role is unknown or not specified
                return redirect()->route('home')->with('error', 'Invalid role.');
            }
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }

    }
}
