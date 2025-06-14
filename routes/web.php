<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\DashboardController;

// Public welcome page
Route::get('/', function () {
   return redirect()->route('login');
});

// Auth routes from Breeze
require __DIR__.'/auth.php';

// Admin-only: products & dashboard
//Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
    Route::resource('products', ProductController::class);
//});

// Admin + Salesperson: sales orders
//Route::middleware(['auth', 'role:Admin|Salesperson'])->group(function () {
    Route::resource('sales-orders', SalesOrderController::class);
    Route::get('sales-orders/{salesOrder}/pdf', [SalesOrderController::class, 'pdf'])->name('sales-orders.pdf');
//});


Route::middleware(['auth'])->group(function () {
    Route::resource('orders', SalesOrderController::class)->except('edit', 'update', 'destroy');
    Route::get('orders/{order}/invoice', [SalesOrderController::class, 'exportPDF'])->name('orders.invoice');
});
