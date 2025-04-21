<?php

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Cache::remember('gilt', 600, function () {
        return User::all();
    });
    return view('welcome');
});


