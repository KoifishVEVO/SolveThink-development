<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

<<<<<<< Updated upstream
// example
Route::get('/dashboard', function() {
=======
// dashboard
Route::post('/dashboard', function() {
>>>>>>> Stashed changes
    return view('dashboard');
});
