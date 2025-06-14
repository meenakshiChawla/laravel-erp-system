<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\SalesOrderApiController;

// Public route to login and get token

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::post('/sales-orders', [SalesOrderApiController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderApiController::class, 'show']);
});
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
