<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoodController;

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

