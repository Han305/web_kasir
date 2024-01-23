<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

Route::controller(AuthController::class)->middleware('guest')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/admin', [AuthController::class, 'login'])->name('login.admin');
    Route::post('/', [AuthController::class, 'login_process'])->name('login.process');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_process'])->name('register.process');
    
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/kasir', [TransaksiController::class, 'index'])->name('index');
    Route::post('/kasir', [TransaksiController::class, 'store'])->name('store');
    Route::post('/cart', [TransaksiController::class, 'addPesanan'])->name('tambah');
    Route::get('/hapus/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    
    Route::get('/kelola', [AdminController::class, 'kelola'])->name('produk');
    Route::get('/add', [AdminController::class, 'add'])->name('produk.add');
    Route::post('/add', [AdminController::class, 'store'])->name('produk.store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('produk.edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('produk.update');
    Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('produk.destroy');
    
    Route::get('/product', [AdminController::class, 'product'])->name('admin.produk');
    Route::get('/product/add', [AdminController::class, 'addProduct'])->name('admin.produk.add');
    Route::post('/product/add', [AdminController::class, 'storeProduct'])->name('admin.produk.store');
    Route::get('/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.produk.edit');
    Route::put('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.produk.update');
    Route::get('/product/delete/{id}', [AdminController::class, 'destroyProduct'])->name('admin.produk.destroy');

    Route::get('/operator', [AdminController::class, 'operator'])->name('admin.operator');
    Route::get('/operator/add', [AdminController::class, 'operatorAdd'])->name('admin.operator.add');
    Route::post('/operator/add', [AdminController::class, 'operatorStore'])->name('admin.operator.store');
    Route::get('/operator/edit/{id}', [AdminController::class, 'operatorEdit'])->name('admin.operator.edit');
    Route::put('/operator/update/{id}', [AdminController::class, 'operatorUpdate'])->name('admin.operator.update');
    Route::get('/operator/delete/{id}', [AdminController::class, 'operatorDelete'])->name('admin.operator.destroy');
    
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');

});
