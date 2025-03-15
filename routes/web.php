<?php

// routes/web.php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('sales', SaleController::class);
    Route::put('/orders/{order}/finish', [OrderController::class, 'finish'])->name('orders.finish');
    Route::patch('/sales/{sale}/mark-as-paid', [SaleController::class, 'markAsPaid'])->name('sales.markAsPaid');
});

Route::get('/api/config/cnpj-url', function () {
    return response()->json([
        'url' => config('app.cnpj_api_url', env('CNPJ_API_URL'))
    ]);
});
