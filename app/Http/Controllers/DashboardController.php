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
        $userId = auth()->id();

        $sales = Sale::where('user_id', $userId)->latest()->limit(5)->get();
        $clients = Client::where('user_id', $userId)->latest()->limit(5)->get();
        $orders = Order::where('user_id', $userId)->latest()->paginate(5);

        return view('dashboard', [
            'sales'   => $sales,
            'clients' => $clients,
            'orders'  => $orders,
        ]);
    }
}
