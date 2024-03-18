<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreTransactionController;
use App\Http\Controllers\WarehouseTransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});;

Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('stores.index');
    Route::get('/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/{id}', [StoreController::class, 'show'])->name('stores.show');
    Route::delete('/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');
});;

Route::prefix('goods')->group(function () {
    Route::get('/', [GoodController::class, 'index'])->name('goods.index');
    Route::get('/create', [GoodController::class, 'create'])->name('goods.create');
    Route::post('/', [GoodController::class, 'store'])->name('goods.store');
    Route::get('/{id}', [GoodController::class, 'show'])->name('goods.show');
    Route::get('/{id}/edit', [GoodController::class, 'edit'])->name('goods.edit');
    Route::put('/{id}', [GoodController::class, 'update'])->name('goods.update');
    Route::delete('/{id}', [GoodController::class, 'destroy'])->name('goods.destroy'); 
});;

Route::prefix('warehouse-transactions')->group(function () {
    Route::get('/', [WarehouseTransactionController::class, 'index'])->name('warehouse_transactions.index');
    Route::get('/pending', [WarehouseTransactionController::class, 'getPendingTransactions'])->name('warehouse_transactions.pending');
    Route::get('/create', [WarehouseTransactionController::class, 'create'])->name('warehouse_transactions.create');
    Route::post('/', [WarehouseTransactionController::class, 'store'])->name('warehouse_transactions.store');
    Route::get('/{id}', [WarehouseTransactionController::class, 'show'])->name('warehouse_transactions.show');
    Route::delete('/{id}', [WarehouseTransactionController::class, 'destroy'])->name('warehouse_transactions.destroy');
    Route::put('/{id}/accept', [WarehouseTransactionController::class, 'acceptTransaction'])->name('warehouse_transactions.accept');
    Route::put('/{id}/reject', [WarehouseTransactionController::class, 'rejectTransaction'])->name('warehouse_transactions.reject');
});;

Route::prefix('store-transactions')->group(function () {
    Route::get('/', [StoreTransactionController::class, 'index'])->name('store_transactions.index');
    Route::get('/pending', [StoreTransactionController::class, 'getPendingTransactions'])->name('store_transactions.pending');
    Route::get('/create', [StoreTransactionController::class, 'create'])->name('store_transactions.create');
    Route::post('/', [StoreTransactionController::class, 'store'])->name('store_transactions.store');
    Route::get('/{id}', [StoreTransactionController::class, 'show'])->name('store_transactions.show');
    Route::delete('/{id}', [StoreTransactionController::class, 'destroy'])->name('store_transactions.destroy');
    Route::put('/{id}/accept', [StoreTransactionController::class, 'acceptTransaction'])->name('store_transactions.accept');
    Route::put('/{id}/reject', [StoreTransactionController::class, 'rejectTransaction'])->name('store_transactions.reject');
});;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');    
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});;
