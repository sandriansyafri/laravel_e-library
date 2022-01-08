<?php

use App\Http\Controllers\AdminContoller;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [AdminContoller::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/anggota', [AdminContoller::class, 'anggota'])->name('anggota');
Route::get('/katalog', [AdminContoller::class, 'katalog'])->name('katalog');
Route::get('/penerbit', [AdminContoller::class, 'penerbit'])->name('penerbit');
Route::get('/pengarang', [AdminContoller::class, 'pengarang'])->name('pengarang');
Route::get('/buku', [AdminContoller::class, 'buku'])->name('buku');
Route::get('/peminjaman', [AdminContoller::class, 'peminjaman'])->name('peminjaman');

Route::get('/test-spatie', [AdminContoller::class, 'test_spatie']);

Route::prefix('data')->group(function () {
    Route::resource('katalog', KatalogController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('pengarang', PengarangController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::resource('buku', BukuController::class);
    Route::resource('peminjaman', PeminjamanController::class);
});
