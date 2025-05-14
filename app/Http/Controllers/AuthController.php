<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if (!empty($request->email)) {
            $user = User::where('email', $request->email)->first();
        }
        if ($user) {
            if ($user->password == $request->password)
                return response()->json($user);
            else
                return response()->json(['msg' => 'errore in password']);
        }
        return response()->json(['msg' => 'errore in email']);
    }

}
