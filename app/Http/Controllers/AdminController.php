<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new admin
        $admin = Admin::create([
            'fullname' => $validated['fullname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Hash the password before saving
        ]);

        return response()->json([
            'message' => 'Admin registration successful.',
            'admin' => $admin,
        ]);
    }
}
