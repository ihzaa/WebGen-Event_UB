<?php

use App\Http\Controllers\Admin\AuthController as adminAuth;
use App\Http\Controllers\User\HomeUserController;
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
    Route::get('/', [HomeUserController::class, 'index'])->name('home');
});


Route::name('admin_')->middleware('auth:admin')->prefix('4dm1n')->group(function () {
    Route::get('/', function () {
        return view('admin.template.master');
    })->name('home');
    Route::get('logout', [adminAuth::class, 'logout'])->name('logout');
});

Route::get('/4dm1n/login', [adminAuth::class, 'loginGet'])->name('admin_login_get')->middleware('guest');
Route::post('/4dm1n/login', [adminAuth::class, 'loginPost'])->name('admin_login_post')->middleware('guest');
