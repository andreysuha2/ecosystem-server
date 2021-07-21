<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Authenticate\RegistrationRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Modes\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $user = User::where('email', $request->email)->first();
        if(!$user) return response()->json([ 'message' => "Invalid credentials" ], 422);
        if(Hash::check($request->getPassword(), $user->password)) {
            return response()->json([ 'token' => $user->createToken('user_auth_token')->plainTextToken ]);
        }
        return response()->json([ 'message' => "Invalid credentials" ], 422);
    }

    public function registration(RegistrationRequest $request) {
        $user = User::create(array_merge($request->toArray(), [ 'password' => Hash::make($request->getPassword()) ]));
        return response()->json([ 'token' => $user->createToken('user_auth_token')->plainTextToken ]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([ 'message' => "success" ], 200);
    }
}
