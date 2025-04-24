<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangBaruController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\BarangBekasController;
use App\Http\Controllers\NamaBarangController;
use App\Models\AsetBarangBaru;
use App\Models\NamaBarang;
use App\Models\AsetBarangBekas;
use App\Http\Controllers\penjualanBarangController;
use App\Http\Controllers\penyewaanBarangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// authentication
Route::get('/', [AuthController::class, 'showLogin'])->name('login.show')->middleware('guest');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show')->middleware('guest');
Route::post('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/login', [AuthController::class, 'Login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('dashboard', function() {
//     return view('dashboard');
// })->name('dashboard')->middleware('auth');


// dashboard
// Route::get('/dashboard', function() {
//     return view('rincianNamaBarang');
// })->name('dashboard')->middleware('auth');


// rincian barang baru
// Route::post('/aset-barang-baru', [BarangBaruController::class, 'store'])->name('aset_barang.store');
// Route::post('/aset-barang-baru/same', [BarangBaruController::class, 'storeSame'])->name('aset_barang.storeSame');
// Route::put('/aset-barang-baru/{id}', [BarangBaruController::class, 'update'])->name('aset_barang.update');
// Route::delete('/aset-barang-baru/{id}', [BarangBaruController::class, 'destroy'])->name('aset_barang.destroy');
// Route::delete('/aset_barang/deleteOne/{nama_barang}', [BarangBaruController::class, 'deleteOne'])
//     ->name('aset_barang.deleteOne');

Route::middleware(['auth'])->group(function () {
    // rincian barang baru
    Route::get('/rincianBarangBaru', function (Request $request) {
        $search = $request->input('search');

        $barang = AsetBarangBaru::select(
                DB::raw('MAX(id) as id'), // ambil satu ID wakil per grup
                'id_nama_barang',
                'jenis_barang',
                'harga_jual_barang',
                DB::raw('COUNT(*) as jumlah')
            )
            ->with('namaBarang') // pastikan relasi ada
            ->when($search, function ($query, $search) {
                $query->whereHas('namaBarang', function ($q) use ($search) {
                    $q->where('nama_barang', 'LIKE', "%{$search}%");
                });
            })
            ->groupBy('id_nama_barang', 'jenis_barang', 'harga_jual_barang')
            ->paginate(3)
            ->appends(['search' => $search]);

        $data_nama_barang = NamaBarang::all();

        return view('rincianBarangBaru', compact('barang', 'search', 'data_nama_barang'));
    })->name('aset_barang.index');
    Route::post('/aset-barang-baru', [BarangBaruController::class, 'store'])->name('aset_barang.store');
    Route::post('/aset-barang-baru/same', [BarangBaruController::class, 'storeSame'])->name('aset_barang.storeSame');
    Route::put('/aset-barang-baru/{id}', [BarangBaruController::class, 'update'])->name('aset_barang.update');
    Route::delete('/aset-barang-baru/{id}', [BarangBaruController::class, 'destroy'])->name('aset_barang.destroy');
    Route::delete('/aset_barang/deleteOne/{id_nama_barang}', [BarangBaruController::class, 'deleteOne'])->name('aset_barang.deleteOne');
});


// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NamaBarangController::class, 'index'])->name('nama_barang.index');
    Route::post('/rincianNamaBarang', [NamaBarangController::class, 'store'])->name('nama_barang.store');
    Route::put('/rincianNamaBarang/{id}', [NamaBarangController::class, 'update'])->name('nama_barang.update');
    Route::delete('/rincianNamaBarang/{id}', [NamaBarangController::class, 'destroy'])->name('nama_barang.destroy');
});




// rincian barang bekas
// Route::post('/aset-barang-bekas', [BarangBekasController::class, 'store'])->name('aset_barang_bekas.store');
// Route::post('/aset-barang-bekas/same', [BarangBekasController::class, 'storeSame'])->name('aset_barang_bekas.storeSame');
// Route::put('/aset-barang-bekas/{id}', [BarangBekasController::class, 'update'])->name('aset_barang_bekas.update');
// Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
// Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
// Route::delete('/aset_barang-bekas/deleteOne/{nama_barang}', [BarangBekasController::class, 'deleteOne'])
//     ->name('aset_barang_bekas.deleteOne');

Route::middleware(['auth'])->group(function () {
    // rincian barang bekas
    Route::get('/rincianBarangBekas', function (Request $request) {
        $search = $request->input('search');

        $barang = AsetBarangBekas::select(
                DB::raw('MAX(id) as id'), // ambil salah satu id sebagai wakil
                'id_nama_barang',
                'jenis_barang',
                'harga_jual_barang',
                DB::raw('COUNT(*) as jumlah')
            )
            ->with('namaBarang')
            ->when($search, function ($query, $search) {
                $query->whereHas('namaBarang', function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%$search%");
                });
            })
            ->groupBy('id_nama_barang', 'jenis_barang', 'harga_jual_barang')
            ->paginate(3)
            ->appends(['search' => $search]);

        $data_nama_barang = NamaBarang::all();

        return view('rincianBarangBekas', compact('barang', 'search', 'data_nama_barang'));
    })->name('aset_barang_bekas.index');
    Route::post('/aset-barang-bekas', [BarangBekasController::class, 'store'])->name('aset_barang_bekas.store');
    Route::post('/aset-barang-bekas/same', [BarangBekasController::class, 'storeSame'])->name('aset_barang_bekas.storeSame');
    Route::put('/aset-barang-bekas/{id}', [BarangBekasController::class, 'update'])->name('aset_barang_bekas.update');
    Route::delete('/aset-barang-bekas/{id}', [BarangBekasController::class, 'destroy'])->name('aset_barang_bekas.destroy');
    Route::delete('/aset_barang-bekas/deleteOne/{nama_barang}', [BarangBekasController::class, 'deleteOne'])->name('aset_barang_bekas.deleteOne');
});




// periode
Route::get('/periode', [PeriodeController::class, 'index'])->name('periode.show');
Route::post('/periode', [PeriodeController::class, 'store'])->name('periode.store');
Route::delete('/periode/{id}', [PeriodeController::class, 'destroy'])->name('periode.destroy');
Route::put('/periode/{id}', [PeriodeController::class, 'update'])->name('periode.update');


// penyewaan barang
Route::get('/penyewaanBarang', [penyewaanBarangController::class, 'index'])->name('penyewaan.show');
// penjualan barang
Route::get('/penjualanBarang', [penjualanBarangController::class, 'index'])->name('penjualan.show');

Route::get('/tes', function () {
    return view('tes');
});