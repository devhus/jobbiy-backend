<?php

use Modules\Job\Http\Controllers\Api\ApplicationController;
use Modules\Job\Http\Controllers\Api\EmployerJobController;
use Modules\Job\Http\Controllers\Api\JobController;

Route::prefix('jobs')->group(function () {
    Route::get('/', [JobController::class, 'index']);
    Route::get('/{id}', [JobController::class, 'show']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/{id}/apply', [JobController::class, 'apply']);
    });
});

Route::prefix('employer')->middleware(['employer'])->group(function () {
    Route::prefix('jobs')->group(function () {
        Route::get('/', [EmployerJobController::class, 'index']);
        Route::post('/', [EmployerJobController::class, 'updateOrCreate']);
        Route::get('/{id}', [EmployerJobController::class, 'show']);
        Route::put('/{id}', [EmployerJobController::class, 'updateOrCreate']);
        Route::delete('/{id}', [EmployerJobController::class, 'destroy']);

        Route::get('/{jobId}/applications', [ApplicationController::class, 'index']);
        Route::put('/{jobId}/applications/{applicationId}', [ApplicationController::class, 'updateStatus']);
    });
});
