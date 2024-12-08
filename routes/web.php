<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;

Route::resource('clients', ClientController::class);
Route::resource('orders', OrderController::class);
Route::resource('sales', SaleController::class);

Route::get('/api/config/cnpj-url', function () {
    return response()->json([
        'url' => config('app.cnpj_api_url', env('CNPJ_API_URL'))
    ]);
});
