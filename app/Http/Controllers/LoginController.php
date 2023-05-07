<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPlayerRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(
        LoginPlayerRequest $request
    ): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Nieprawidłowy email lub hasło',
                'errors' => [
                    'login' => 'Nieprawidłowy email lub hasło',
                ],
            ], 422);
        }

        return response()->json([
            'token' => $user->createToken('user-token')->plainTextToken,
            'user' => new UserResource($user),
        ]);
    }
}
