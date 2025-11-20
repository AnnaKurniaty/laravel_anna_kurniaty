<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\PasienController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::resource('rumahsakit', RumahSakitController::class);
    Route::resource('pasien', PasienController::class);

    Route::delete('/pasien-ajax/{id}', [PasienController::class, 'destroyAjax'])
        ->name('pasien.destroy.ajax');

    Route::get('/filter-pasien', [PasienController::class, 'filter'])
        ->name('pasien.filter');
});
