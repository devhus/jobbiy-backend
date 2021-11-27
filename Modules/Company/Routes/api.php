<?php

use Modules\Company\Http\Controllers\Api\CompanyController;

Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{id}', [CompanyController::class, 'show']);
});

Route::prefix('employer')->middleware(['employer'])->group(function () {
    Route::prefix('company')->group(function () {
        Route::get('/', [CompanyController::class, 'userCompany']);
        Route::post('/', [CompanyController::class, 'modify']);
    });
});
