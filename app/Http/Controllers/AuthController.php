<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRegisterRequest; // Form Validation
use App\Http\Requests\UserLoginRequest; // Form Validation
use App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        if (!$token = auth()->attempt($request->only(['email', 'password'])))
        {
            return abort(401);
        }

        // we format data with the UserResource class
        // we set additional meta with token
        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token
            ]
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'errors' => [
                    'email' => ['User not found']
                ]
            ], 422);
        }

        // we format data with the UserResource class
        // we set additional meta with token
        return (new UserResource($request->user()))->additional([
            'meta' => [
                'token' => $token,
            ],
        ]);
    }

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout( Request $request )
    {
        auth()->logout();
    }
}
