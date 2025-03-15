<?php

namespace App\Http\Controllers;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService, protected SaleService $saleService)
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $activeOrders = Order::where('user_id', auth()->id())->where('finished', false)->get();
        $finishedOrders = Order::where('user_id', auth()->id())->where('finished', true)->get();

        return view('orders.index', compact('activeOrders', 'finishedOrders'));
    }

    public function create(): View
    {
        $this->authorize('create', Order::class);
        $sales = $this->saleService->getSalesWithoutOrder(auth()->id());
        return view('orders.create', compact('sales'));
    }

    public function finish(Order $order): RedirectResponse
    {
        $this->authorize('finish', $order);
        $order->update(['finished' => true]);
        return redirect()->route('orders.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $orderData = OrderDTO::fromRequest($request);
        $orderData->user_id = auth()->id();

        $this->orderService->storeOrder($orderData);
        return redirect()->route('orders.index');
    }

    public function show(Order $order): View
    {
        $this->authorize('view', $order);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order): View
    {
        $this->authorize('update', $order);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $this->authorize('update', $order);
        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);
        $order->delete();
        return redirect()->route('orders.index');
    }
}

