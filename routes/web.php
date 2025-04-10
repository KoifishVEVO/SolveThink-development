<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangBaruController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\BarangBekasController;
use App\Models\AsetBarangBaru;
use App\Models\AsetBarangBekas;
use Illuminate\Support\Facades\Route;



// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show')->middleware('guest');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

Route::get('dashboard', function() {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


// dashboard
Route::get('/dashboard', function() {
    return view('rincianNamaBarang');
})->name('dashboard')->middleware('auth');

Route::get('/rincianNamaBarang', function() {
    return view('rincianNamaBarang');
});

Route::get('/rincianBarangBaru', function() {
    $barang = AsetBarangBaru::all();
    return view('rincianBarangBaru', compact('barang'));
})->name('aset_barang.index');

Route::get('/rincianBarangBekas', function() {
   $barang = AsetBarangBekas::all();
    return view('rincianBarangBekas', compact('barang'));
})->name('aset_barang_bekas.index');

// rincian barang
Route::post('/aset-barang-baru', [BarangBaruController::class, 'store'])->name('aset_barang.store');
Route::put('/aset-barang-baru/{id}', [BarangBaruController::class, 'update'])->name('aset_barang.update');
Route::delete('/aset-barang-baru/{id}', [BarangBaruController::class, 'destroy'])->name('aset_barang.destroy');

// rincian barang bekas
<<<<<<< Updated upstream
Route::post('/aset-barang-bekas', [BarangBaruController::class, 'store'])->name('aset_barang_bekas.store');
Route::put('/aset-barang-bekas/{id}', [BarangBaruController::class, 'update'])->name('aset_barang_bekas.update');
Route::delete('/aset-barang-bekas/{id}', [BarangBaruController::class, 'destroy'])->name('aset_barang_bekas.destroy');
=======
Route::post('/aset-barang-bekas', [BarangBekasController::class, 'store'])->name('aset_barang_bekas.store');
Route::post('/aset-barang-bekas/same', [BarangBekasController::class, 'storeSame'])->name('aset_barang_bekas.storeSame');
Route::put('/aset-barang-bekas/{id}', [BarangBekasController::class, 'update'])->name('aset_barang_bekas.update');
Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
Route::delete('/aset_barang-bekas/deleteOne/{nama_barang}', [BarangBekasController::class, 'deleteOne'])
    ->name('aset_barang_bekas.deleteOne');




    // periode
Route::get('/periode', [PeriodeController::class, 'show'])->name('periode.show');
>>>>>>> Stashed changes
