<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

// dashboard
Route::get('/dashboard', function() {
    return view('dashboard');
});
