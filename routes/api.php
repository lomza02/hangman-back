<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['api']], function (): void {
    Route::post('register', [RegisterController::class, 'register'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::delete('logout', [LogoutController::class, 'logout'])->name('logout');
    });

    Route::prefix('v1')
    ->name('v1.')
    ->group(function (): void {
        Route::middleware('auth:sanctum')->group(function (): void {
            Route::get('games', [GameController::class, 'index'])->name('indexGames');
            Route::post('games', [GameController::class, 'store'])->name('storeGame');
            Route::put('games/{game}', [GameController::class, 'update'])->name('updateGame');
            Route::get('users/{user}/games', [GameController::class, 'usersGames'])->name('getUsersGames');
        });
    });
});
