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

    // Route Controller menu untuk kasir
    Route::controller(TransaksiController::class)->group(function() {
        Route::get('/kasir', 'index')->name('index');
        Route::post('/kasir/{kode_produk}', 'store')->name('store');
        Route::post('/cart', 'addPesanan')->name('tambah');
        Route::get('/hapus/{id}', 'destroy')->name('destroy');
        Route::get('/struk/{no_invoice}', 'struk')->name('struk');
    });
    
    // Route controller admin
    Route::controller(AdminController::class)->group(function() {

        Route::get('/dashboard', 'index')->name('admin.index');

        // Route untuk bagian kasir, untuk mengelola produk
        Route::get('/kelola', 'kelola')->name('produk');
        Route::get('/add', 'add')->name('produk.add');
        Route::post('/add', 'store')->name('produk.store');
        Route::get('/edit/{kode_produk}', 'edit')->name('produk.edit');
        Route::put('/update/{kode_produk}', 'update')->name('produk.update');
        Route::get('/delete/{kode_produk}', 'destroy')->name('produk.destroy');

        Route::get('/product', 'product')->name('admin.produk');
        Route::get('/product/add', 'addProduct')->name('admin.produk.add');
        Route::post('/product/add', 'storeProduct')->name('admin.produk.store');
        Route::get('/product/edit/{kode_produk}', 'editProduct')->name('admin.produk.edit');
        Route::put('/product/update/{kode_produk}', 'updateProduct')->name('admin.produk.update');
        Route::get('/product/delete/{kode_produk}', 'destroyProduct')->name('admin.produk.destroy');
    
        Route::get('/operator', 'operator')->name('admin.operator');
        Route::get('/operator/add', 'operatorAdd')->name('admin.operator.add');
        Route::post('/operator/add', 'operatorStore')->name('admin.operator.store');
        Route::get('/operator/edit/{id}', 'operatorEdit')->name('admin.operator.edit');
        Route::put('/operator/update/{id}', 'operatorUpdate')->name('admin.operator.update');
        Route::get('/operator/delete/{id}', 'operatorDelete')->name('admin.operator.destroy');
        
        Route::get('/laporan', 'laporan')->name('laporan');
    });
    

});
