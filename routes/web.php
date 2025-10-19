<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JenisDokumenController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('kategori', KategoriController::class);
Route::resource('warga', WargaController::class);
Route::get('/jenis-dokumen', [JenisDokumenController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');