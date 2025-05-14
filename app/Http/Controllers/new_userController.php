<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\new_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class new_userController extends Controller
{
    public function login(Request $request): JsonResponse
{
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = new_user::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid password'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

public function register(Request $request): JsonResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    $new_user= new_user::create([
        'name'=>$validated['name'],
        'email'=>$validated['email'],
        'password'=>Hash::make($validated['password'])
    ]);
    return response()->json([
        'message' => 'Register successful',
        'user'=>$new_user
    ],201);
}


}
