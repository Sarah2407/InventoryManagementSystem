<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;

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

Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('stores.index');
    Route::get('/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/{id}', [StoreController::class, 'show'])->name('stores.show');
    Route::delete('/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');
});;