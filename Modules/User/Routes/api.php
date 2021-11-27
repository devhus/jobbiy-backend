<?php

use Modules\User\Http\Controllers\Api\AuthController;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', [AuthController::class, 'user'])->name('auth.user');
    });
});
