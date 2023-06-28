<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PengeluaranController;

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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(PengeluaranController::class)->prefix('pengeluaran')->name('pengeluaran.')->group( function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/delete/{id}', 'delete')->name('delete');
        Route::post('/update/{id}', 'update')->name('update');
    });

    Route::controller(PenjualanController::class)->prefix('penjualan')->name('penjualan.')->group( function() {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group( function() {
        Route::post('/store', 'store')->name('store');
        Route::post('/delete/{id}', 'delete')->name('delete');
        Route::post('/update/{id}', 'update')->name('update');
    });

    Route::controller(TransaksiController::class)->prefix('transaksi')->name('transaksi.')->group( function() {
        Route::post('/store', 'store')->name('store');
    });
});
