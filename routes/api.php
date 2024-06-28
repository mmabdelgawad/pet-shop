<?php

use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\ResetPasswordController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\User\UserOrderController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', LoginController::class);
        Route::post('/forgot-password', ForgotPasswordController::class);
        Route::post('/reset-password', ResetPasswordController::class);

        Route::post('/logout', LogoutController::class)->middleware(JwtMiddleware::class);
    });

    Route::middleware(JwtMiddleware::class)->group(function () {
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('brands', BrandController::class);
        Route::apiResource('promotions', PromotionController::class);

        Route::prefix('user')->group(function () {
            Route::apiResource('orders', UserOrderController::class);
        });
    });
});
