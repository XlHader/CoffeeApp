<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Sale\SaleController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Category\CategoryController;

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

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {

    /*********************************************
     *               Auth Routes                 *
     *********************************************/

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/refresh', [AuthController::class, 'refresh']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    /*********************************************
     *             Category Routes               *
     *********************************************/
    Route::apiResource('category', CategoryController::class);

    /*********************************************
     *             Product Routes                *
     *********************************************/
    Route::apiResource('product', ProductController::class);

    /*********************************************
     *               Sale Routes                 *
     *********************************************/
    Route::apiResource('sale', SaleController::class);
    Route::get('sale/product/{id}', [SaleController::class, 'salesByProduct']);
});
