<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/kasir', [TransaksiController::class, 'index'])->name('index');
Route::post('/kasir', [TransaksiController::class, 'store'])->name('store');
Route::post('/cart', [TransaksiController::class, 'addPesanan'])->name('tambah');
Route::get('/hapus/{id}', [TransaksiController::class, 'destroy'])->name('destroy');

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

Route::get('/category', [AdminController::class, 'category'])->name('admin.category');
Route::get('/category/add', [AdminController::class, 'addCategory'])->name('admin.category.add');
Route::post('/category/add', [AdminController::class, 'storeCategory'])->name('admin.category.store');
Route::get('/category/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.category.edit');
Route::put('/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
Route::get('/category/delete/{id}', [AdminController::class, 'destroyCategory'])->name('admin.category.destroy');

Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');