<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => 'pong');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'get']);
        Route::put('/', [ProfileController::class, 'update']);
        Route::post('/avatar', [ProfileController::class, 'updateAvatar'])->middleware('throttle:3,1');
        Route::delete('/avatar', [ProfileController::class, 'deleteAvatar']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/me', [UserController::class, 'get']);
        Route::delete('/account', [UserController::class, 'delete']);
        Route::get('/actions', [UserController::class, 'getActions']);
    });

});
