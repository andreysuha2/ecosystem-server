<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Authenticate\RegistrationRequest;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Modes\User;
use App\Http\Resources\User\UserResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {}

    public function registration(RegistrationRequest $request) {
        $user = User::create($request->toArray());
        return new UserResource($user);
    }

    public function logout(Request $request) {}
}
