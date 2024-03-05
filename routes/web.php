<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\BukuUlasanController;
use App\Http\Controllers\KoleksiPribadiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PerpusController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// kontroller yang hanya bisa diakses oleh guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});

// kontroller yang hanya bisa diakses oleh user ter autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::post('/logout', [LoginController::class, 'logout']);

    Route::get('/search', [SearchController::class, 'index']);

    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{buku}', [BukuController::class, 'show'])->name('buku.show');

    Route::get('/koleksi_pribadi', [KoleksiPribadiController::class, 'index'])->name('koleksi_pribadi.index');
    Route::post('/koleksi_pribadi', [KoleksiPribadiController::class, 'store'])->name('koleksi_pribadi.store');
    Route::delete('/koleksi_pribadi/{koleksi_pribadi}', [KoleksiPribadiController::class, 'destroy'])->name('koleksi_pribadi.destroy');

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
});

// kontroller yang hanya bisa diakses oleh anggota
Route::middleware('anggota')->group(function () {
    Route::post('/ulasan', [BukuUlasanController::class, 'store'])->name('ulasan.store');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});

// kontroller yang bisa diakses oleh petugas
Route::middleware('petugas')->group(function () {
    Route::get('/penerbit', [PenerbitController::class, 'index'])->name('penerbit.index');

    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/laporan/filter', [LaporanController::class, 'filter']);
    Route::get('/laporan/export', [LaporanController::class, 'export']);
});

// kontroller yang hanya bisa diakses oleh admin
Route::middleware('admin')->group(function () {
    Route::get('/ulasan', [BukuUlasanController::class, 'index'])->name('ulasan.index');
    Route::delete('/ulasan/{bukuUlasan}', [BukuUlasanController::class, 'destroy'])->name('ulasan.destroy');

    Route::put('/peminjaman/{peminjaman}', [PeminjamanController::class, 'update'])->name('peminjaman.update');

    Route::get('/perpustakaan', [PerpusController::class, 'index'])->name('perpustakaan.index');
    Route::post('/perpustakaan', [PerpusController::class, 'store'])->name('perpustakaan.store');
    Route::put('/perpustakaan/{perpus}', [PerpusController::class, 'update'])->name('perpustakaan.update');
    Route::delete('/perpustakaan/{perpus}', [PerpusController::class, 'destroy'])->name('perpustakaan.destroy');

    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{user}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{user}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
});
