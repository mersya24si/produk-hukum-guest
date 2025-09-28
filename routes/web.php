<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\JenisDokumenController;

Route::get('/jenis-dokumen', [JenisDokumenController::class, 'index']);
