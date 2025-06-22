<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '\d+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('base', '[a-zA-Z0-9]+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('username', '[a-z0-9_-]{3,16}');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->middleware('guest:sanctum')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

/**
 * User Logout
 */
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::prefix('books')->group(function () {
            Route::post('/create', [BookController::class, 'store']);
            Route::put('/update/{id}', [BookController::class, 'update']);
            Route::delete('/delete/{id}', [BookController::class, 'delete']);
        });

        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']);
            Route::get('/{id}', [BookingController::class, 'show']);
            Route::delete('/delete/{id}', [BookingController::class, 'delete']);

        });
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin|user')->group(function () {
        Route::prefix('books')->group(function () {
            Route::get('/', [BookController::class, 'index']);
            Route::get('/{id}', [BookController::class, 'show']);
        });

        Route::prefix('bookings')->group(function () {
            Route::post('/create', [BookingController::class, 'create']);
            Route::put('/update/{id}', [BookingController::class, 'update']);
        });
    });
});

