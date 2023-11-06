<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'bail|required|string|max:55',
            'email' => 'bail|required|string|max:60|min:2|email|unique:users,email',
            'password' => 'bail|required|string|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'User Registration failed.',
                'errors' => $validator->errors(),
            ], 401);
        }

        $user = new User();

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'token' => $user->createToken('token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 200);

    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'User Login failed.',
                'error' => $validator->errors(),
            ], 401);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'error' => 'Could not login, wrong credentials.',
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token' => $user->createToken('token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 200);

    }

    public function unauthorized()
    {
        return response()->json([
            'error' => 'Unauthorized.',
        ], 401);
    }
}
