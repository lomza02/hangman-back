<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class LogoutController extends Controller
{
    public function logout(): JsonResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Wylogowano!',
        ], 200);
    }
}
