<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return response()->json(['message' => 'Display login form']);
    }

    public function showRegisterForm()
    {
        return response()->json(['message' => 'Display registration form']);
    }

    public function register(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        // Create a new admin
        $admin = Admin::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Admin registered successfully!'], 200);
    }

    public function login(Request $request)
    {
        // Attempt login with provided credentials
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return response()->json(['message' => 'Login successful!', 'user' => Auth::guard('admin')->user()], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return response()->json(['message' => 'Admin logged out successfully']);
    }
}
