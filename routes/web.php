<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::prefix('auth')->group(function() {
        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login', [LoginController::class, 'authenticate']);
    });
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('user')->group(function() {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    });
});
