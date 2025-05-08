<?php

namespace App\Http\Controllers;
use App\Mail\WelcomeMail;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email' => 'required|string|unique:users,email|max:200',
            'password' => 'required|confirmed|string|min:8',

        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Mail::to($user->email)->send(new WelcomeMail($user));
        return response()->json(
            [
                'message' => 'User Registered Successfuly',
                'User' => $user
            ],
            201
        );
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json(['message' => 'inviled email or password'], 401);
        $user = User::where('email', $request->email)->first();
        $tokenUser = $user->createToken('auth_Token')->plainTextToken;
        return response()->json([
            'message' => 'login successfuly',
            'User' => $user,
            'token' => $tokenUser,
        ], 201);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'logout successful']);
    }
}
