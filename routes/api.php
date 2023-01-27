<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::post('/', [UsersController::class, 'create']);

        Route::prefix('{id}')->group(function () {
            Route::get('/', [UsersController::class, 'show']);
            Route::patch('/', [UsersController::class, 'update']);
            Route::delete('/', [UsersController::class, 'delete']);

            Route::get('/payments', [UsersController::class, 'payments']);
            Route::post('/payments', [UsersController::class, 'createPayment']);
        });
    });
});
