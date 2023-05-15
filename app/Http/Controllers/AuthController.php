<?php

namespace App\Http\Controllers;

use App\Models\User;
use Core\Core;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'Successfully created user!',
                'accessToken' => $token,
            ], 201);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : (preg_match('/^[0-9]{10}+$/', $request->email) ? 'phone' : 'username');

        $credentials = [
            $field => request('email'),
            'password' => request('password'),
        ];
        if (! Auth::attempt($credentials)) {
            return Core::createReturn(false, [], 'Your username or password is incorrect');
        }

        $user = $request->user();
        $tokenResult = $user->createToken($user->name.' Access Token');
        $token = $tokenResult->plainTextToken;

        return Core::createReturn(true, [
            'accessToken' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 'Successfully logged in');
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete()) {
            return Core::createReturn(true, [], 'Successfully logged out');
        }
    }
}
