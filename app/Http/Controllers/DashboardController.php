<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $sales = Sale::query()->latest()->limit(5)->get();
        $clients = Client::query()->latest()->limit(5)->get();
        $orders = Order::query()->latest()->paginate(5);

        return view('dashboard', [
            'sales' => $sales,
            'clients' => $clients,
            'orders' => $orders,
        ]);
    }
}
