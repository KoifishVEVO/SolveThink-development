<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangBaruController;
use App\Http\Controllers\BarangBekasController;
use Illuminate\Support\Facades\Route;



// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

Route::get('dashboard', function() {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


// dashboard
Route::post('/dashboard', function() {
    return view('dashboard');
});

Route::get('/rincianNamaBarang', function() {
    return view('rincianNamaBarang');
});

Route::get('/rincianBarangBaru', function() {
    return view('rincianBarangBaru');
});

Route::get('/rincianBarangBekas', function() {
    return view('rincianBarangBekas');

});



//rincian barang
Route::post('/storeAsetBarangBaru', [App\Http\Controllers\BarangBaruController::class, 'store'])->name('aset_barang_baru.store');

