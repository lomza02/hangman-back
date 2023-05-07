<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterPlayerRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(
        RegisterPlayerRequest $request
    ): JsonResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return response()->json([
            'token' => $user->createToken('user-token')->plainTextToken,
            'user' => new UserResource($user),
        ]);
    }
}
