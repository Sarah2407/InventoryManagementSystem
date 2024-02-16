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

// Route::prefix('categories')->group(function () {
//     Route::get('/', [CategoryController::class, 'index']);
//     Route::post('/', [CategoryController::class, 'store']);
//     Route::get('/{id}', [CategoryController::class, 'show']);
//     Route::put('/{id}', [CategoryController::class, 'update']);
//     Route::delete('/{id}', [CategoryController::class, 'destroy']);
// });


// Route::prefix('stores')->group(function () {
//     Route::get('/', [StoreController::class, 'index']);
//     Route::post('/', [StoreController::class, 'store']);
//     Route::get('/{id}', [StoreController::class, 'show']);
//     Route::put('/{id}', [StoreController::class, 'update']);
//     Route::delete('/{id}', [StoreController::class, 'destroy']);
// });
