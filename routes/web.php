<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::controller(ProfileController::class)->prefix('profil')->name('profil.')->group( function() {
        Route::get('/', 'index')->name('index');
        Route::post('/update', 'update')->name('update');
        Route::get('/change-password', 'changePassword')->name('changePassword');
        Route::post('/change-password', 'changePasswordPost')->name('changePassword.post');
    });

    Route::controller(KategoriController::class)->prefix('kategori')->name('kategori.')->group( function() {
        Route::get('/', 'index')->name('index');
        Route::put('/store', 'store')->name('store');
        Route::put('/delete/{id}', 'delete')->name('delete');
        Route::put('/update/{id}', 'update')->name('update');
    });

    Route::controller(ProdukController::class)->prefix('produk')->name('produk.')->group( function() {
        Route::get('/', 'index')->name('index');
        Route::put('/store', 'store')->name('store');
        Route::put('/delete/{id}', 'delete')->name('delete');
        Route::put('/update/{id}', 'update')->name('update');
    });
});


Route::middleware(['auth','ceklevel:Admin'])->group(function () {
    Route::controller(UserController::class)->prefix('user')->name('user.')->group( function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'delete')->name('delete');
    });
});
