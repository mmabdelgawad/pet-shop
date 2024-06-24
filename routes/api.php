<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class);
    });
});
