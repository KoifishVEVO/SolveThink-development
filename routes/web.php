<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangBaruController;
use App\Http\Controllers\BarangBekasController;
use App\Models\AsetBarangBaru;
use App\Models\AsetBarangBekas;
use Illuminate\Support\Facades\Route;


// authentication
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
    // $barang = AsetBarangBaru::all();
   $barang = AsetBarangBaru::select('aset_barang_baru.*', 'jumlah_per_nama.jumlah')
        ->joinSub(
            AsetBarangBaru::select('nama_barang')
                ->selectRaw('COUNT(*) as jumlah')
                ->groupBy('nama_barang'),
            'jumlah_per_nama',
            'aset_barang_baru.nama_barang',
            '=',
            'jumlah_per_nama.nama_barang'
        )
        ->whereIn('aset_barang_baru.id', function ($query) {
            $query->selectRaw('MAX(id)')->from('aset_barang_baru')->groupBy('nama_barang');
        })
        ->paginate(3);

    return view('rincianBarangBaru', compact('barang'));
})->name('aset_barang.index');

Route::get('/rincianBarangBekas', function() {
//    $barang = AsetBarangBekas::all();
        $barang = AsetBarangBekas::select('aset_barang_bekas.*', 'jumlah_per_nama.jumlah')
        ->joinSub(
            AsetBarangBekas::select('nama_barang')
                ->selectRaw('COUNT(*) as jumlah')
                ->groupBy('nama_barang'),
            'jumlah_per_nama',
            'aset_barang_bekas.nama_barang',
            '=',
            'jumlah_per_nama.nama_barang'
        )
        ->whereIn('aset_barang_bekas.id', function ($query) {
            $query->selectRaw('MAX(id)')->from('aset_barang_bekas')->groupBy('nama_barang');
        })
        ->get();
    return view('rincianBarangBekas', compact('barang'));
})->name('aset_barang_bekas.index');

// rincian barang baru
Route::post('/aset-barang-baru', [BarangBaruController::class, 'store'])->name('aset_barang.store');
Route::post('/aset-barang-baru/same', [BarangBaruController::class, 'storeSame'])->name('aset_barang.storeSame');
Route::put('/aset-barang-baru/{id}', [BarangBaruController::class, 'update'])->name('aset_barang.update');
Route::delete('/aset-barang-baru/{id}', [BarangBaruController::class, 'destroy'])->name('aset_barang.destroy');
Route::delete('/aset_barang/deleteOne/{nama_barang}', [BarangBaruController::class, 'deleteOne'])
    ->name('aset_barang.deleteOne');

// rincian barang bekas
Route::post('/aset-barang-bekas', [BarangBekasController::class, 'store'])->name('aset_barang_bekas.store');
Route::post('/aset-barang-bekas/same', [BarangBekasController::class, 'storeSame'])->name('aset_barang_bekas.storeSame');
Route::put('/aset-barang-bekas/{id}', [BarangBekasController::class, 'update'])->name('aset_barang_bekas.update');
Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
Route::delete('/aset_barang-bekas/deleteOne/{nama_barang}', [BarangBekasController::class, 'deleteOne'])
    ->name('aset_barang_bekas.deleteOne');
