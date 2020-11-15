<?php

use App\Http\Controllers\Admin\AuthController as adminAuth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\EventController;
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
    Route::get('/', [DashboardAdminController::class, 'index'])->name('home');
    Route::get('logout', [adminAuth::class, 'logout'])->name('logout');

    Route::get('kelola/event', [EventController::class, 'index'])->name('kelola_event_index');
    Route::get('category/all/w/eventcount', [CategoryController::class, 'getAllVategoryWithCountEvent'])->name('get_all_category_with_event_count');
    Route::post('category/add', [CategoryController::class, 'insert'])->name('tambah_category');
    Route::post('category/edit/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::post('category/delete', [CategoryController::class, 'delete'])->name('delete_category');
});

Route::get('/4dm1n/login', [adminAuth::class, 'loginGet'])->name('admin_login_get')->middleware('guest');
Route::post('/4dm1n/login', [adminAuth::class, 'loginPost'])->name('admin_login_post')->middleware('guest');
