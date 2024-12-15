<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;

Route::resource('clients', ClientController::class);
Route::resource('orders', OrderController::class);
Route::resource('sales', SaleController::class);
Route::put('/orders/{order}/finish', [OrderController::class, 'finish'])->name('orders.finish');
Route::patch('/sales/{sale}/mark-as-paid', [SaleController::class, 'markAsPaid'])->name('sales.markAsPaid');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/api/config/cnpj-url', function () {
    return response()->json([
        'url' => config('app.cnpj_api_url', env('CNPJ_API_URL'))
    ]);
});
