<?php

use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AkunController;
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


Route::name('user_')->group(function () {
    // Route Front User Disini Ya kaka ulfah
});


Route::name('admin_')->middleware('auth:admin')->prefix('4dm1n')->group(function () {
    // Ini Route admin Ya kaka ulfah
    Route::get('/kelolaAdvertisement', [AdvertisementController::class, 'index'])->name('advertisement_index');
    Route::get('/kelolaAdvertisement/tambah', [AdvertisementController::class, 'create'])->name('advertisement_tambah');
    Route::post('/kelolaAdvertisement/store', [AdvertisementController::class, 'store'])->name('advertisement_store');
    Route::get('/kelolaAdvertisement/edit/{id}', [AdvertisementController::class, 'edit'])->name('advertisement_edit');
    Route::post('/kelolaAdvertisement/update/{id}', [AdvertisementController::class, 'update'])->name('advertisement_update');
    Route::delete('/kelolaAdvertisement/delete/{id}', [AdvertisementController::class, 'destroy'])->name('advertisement_delete');

    // ini route kelola akun ya abang ihza
    Route::get('/kelola-akun', [AkunController::class, 'index'])->name('kelola_akun');
    Route::post('/ubah-pass', [AkunController::class, 'ubahPass'])->name('ubah_password');
    Route::post('/ubah-nama', [AkunController::class, 'ubahNama'])->name('ubah_nama');
});
