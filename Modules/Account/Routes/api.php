<?php

use Modules\Account\Http\Controllers\Api\AccountController;

Route::prefix('account')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AccountController::class, 'show']);
    Route::post('/', [AccountController::class, 'update']);
});
