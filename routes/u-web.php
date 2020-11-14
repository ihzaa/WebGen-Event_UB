<?php

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

});
