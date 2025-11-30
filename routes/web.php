<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenHukumController;
use App\Http\Controllers\JenisDokumenController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::resource('auth', AuthController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('warga', WargaController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('user', UserController::class);
Route::resource('jenisdokumen', JenisDokumenController::class);
Route::resource('dokumenhukum', DokumenHukumController::class);
Route::delete('/dokumenhukum/media/{id}', [DokumenHukumController::class, 'deleteMedia'])
         ->name('dokumenhukum.deleteMedia');


Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');



