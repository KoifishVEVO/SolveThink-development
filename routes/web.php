<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

// dashboard
Route::post('/dashboard', function() {
    return view('dashboard');
});

Route::get('/rincianBarangBaru', function() {
    return view('rincianBarangBaru');
});

Route::get('/rincianBarangBekas', function() {
    return view('rincianBarangBekas');
});