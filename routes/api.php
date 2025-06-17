<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
    Route::post('login', [UserController::class, 'login']);
});

/**
 * User Logout
 */
Route::middleware(['auth:sanctum', 'ability:access-token'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [UserController::class, 'logout']);
    });
});


Route::prefix('books')->group(function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
    Route::post('/create', [BookController::class, 'store']);
    Route::put('/update/{id}', [BookController::class, 'update']);
    Route::delete('/delete/{id}', [BookController::class, 'delete']);
});

Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);
    Route::get('/{id}', [BookingController::class, 'show']);
    Route::post('/create', [BookingController::class, 'create']);
    Route::put('/update/{id}', [BookingController::class, 'update']);
    Route::delete('/delete/{id}', [BookingController::class, 'delete']);
});
