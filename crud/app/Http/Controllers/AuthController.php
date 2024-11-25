<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Import your User model
use Validator;

class AuthController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        // You can add countries data here if needed
        $countries = ['USA', 'Canada', 'UK', 'India', 'Australia']; // Sample countries array
        return view('auth.register', compact('countries'));
    }

    // Handle the registration logic
    public function register(Request $request)
    {
        // Validate the input fields
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'username' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
            'image' => 'nullable|image|max:2048', // optional image upload validation
            'country' => 'required|string', // country selection validation
        ]);

        // Handle file upload if any
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
        } else {
            $imagePath = null;  // Set image path to null if no image uploaded
        }

        // Create a new user record
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => $request->role,
            'country' => $request->country,
            'image' => $imagePath,  // Save the uploaded image path
        ]);

        // Redirect to login or dashboard
        return redirect()->route('login')->with('success', 'Registration successful.');
    }
}
