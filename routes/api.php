<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreTransactionController;
use App\Http\Controllers\WarehouseTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('goods')->group(function () {
    Route::get('/', [GoodController::class, 'index']);
    Route::post('/', [GoodController::class, 'store']);
    Route::get('/{id}', [GoodController::class, 'show']);
    Route::put('/{id}', [GoodController::class, 'update']);
    Route::delete('/{id}', [GoodController::class, 'destroy']);
});

Route::prefix('products')->group(function (){
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'index']);
    Route::post('/', [StoreController::class, 'store']);
    Route::get('/{id}', [StoreController::class, 'show']);
    Route::put('/{id}', [StoreController::class, 'update']);
    Route::delete('/{id}', [StoreController::class, 'destroy']);
});

Route::prefix('store_transactions')->group(function () {
    Route::get('/', [StoreTransactionController::class, 'index']);
    Route::post('/', [StoreTransactionController::class, 'store']);
    Route::get('/{id}', [StoreTransactionController::class, 'show']);
    Route::put('/{id}', [StoreTransactionController::class, 'update']);
    Route::delete('/{id}', [StoreTransactionController::class, 'destroy']);
});

Route::prefix('warehouse_transactions')->group(function () {
    Route::get('/', [WarehouseTransactionController::class, 'index']);
    Route::post('/', [WarehouseTransactionController::class, 'store']);
    Route::get('/{id}', [WarehouseTransactionController::class, 'show']);
    Route::put('/{id}', [WarehouseTransactionController::class, 'update']);
    Route::delete('/{id}', [WarehouseTransactionController::class, 'destroy']);
});