<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validation logic
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'studentid' => 'required|unique:users,studentid',
            'courseSection' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'password' => 'required|string|min:8|confirmed', // Ensure password confirmation
        ]);

        // Validation error handling
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // User creation logic
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'studentid' => $request->studentid,
            'courseSection' => $request->courseSection,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role assignment
        ]);
        
        // Return success response
        return response()->json(['message' => 'Registration successful!'], 200);
    }
    
}