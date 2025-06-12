<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {

    Route::prefix('user')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('signup', [AuthController::class, 'signup']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('message')->group(function () {
            Route::get('all', [ChatMessageController::class, 'all']);
            Route::post('send', [ChatMessageController::class, 'send']);
        });
    });
});
