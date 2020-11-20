<?php

use App\Http\Controllers\Admin\AuthController as adminAuth;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\User\AdsController;
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
    Route::get('/get/all/event', [HomeUserController::class, 'getAllEvent'])->name('get_all_event');
    Route::get('/get/event/by/cat/{id}', [HomeUserController::class, 'getEventByCategoryId'])->name('get_event_by_cat_id');
    Route::get('/get/event/by/{id}', [HomeUserController::class, 'getEventById'])->name('get_event_by_id');
    Route::get('/get/latest/ad', [AdsController::class, 'getLatesAd'])->name('get_lates_ad');
});


Route::name('admin_')->middleware('auth:admin')->prefix('4dm1n')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('home');
    Route::get('logout', [adminAuth::class, 'logout'])->name('logout');

    Route::get('kelola/event', [EventController::class, 'index'])->name('kelola_event_index');
    Route::get('kelola/event/tambah', [EventController::class, 'tambahGet'])->name('tambah_event_get');
    Route::post('kelola/event/tambah', [EventController::class, 'tambahPost'])->name('tambah_event_post');
    Route::get('kelola/event/edit/{id}', [EventController::class, 'editGet'])->name('edit_event_get');
    Route::post('kelola/event/edit/{id}', [EventController::class, 'editPost'])->name('edit_event_post');

    Route::get('event/all', [EventController::class, 'getAllEventWithCategoryName'])->name('get_all_event');
    Route::post('event/delete', [EventController::class, 'delete'])->name('delete_event');

    Route::get('category/all/w/eventcount', [CategoryController::class, 'getAllVategoryWithCountEvent'])->name('get_all_category_with_event_count');
    Route::post('category/add', [CategoryController::class, 'insert'])->name('tambah_category');
    Route::post('category/edit/{id}', [CategoryController::class, 'edit'])->name('edit_category');
    Route::post('category/delete', [CategoryController::class, 'delete'])->name('delete_category');
});

Route::get('/4dm1n/login', [adminAuth::class, 'loginGet'])->name('admin_login_get')->middleware('guest');
Route::post('/4dm1n/login', [adminAuth::class, 'loginPost'])->name('admin_login_post')->middleware('guest');
