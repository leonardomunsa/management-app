<?php

namespace App\Http\Controllers;

use App\DTO\OrderDTO;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\SaleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService, protected SaleService $saleService)
    {
    }

    public function index(): View
    {
        $activeOrders = Order::query()->where('finished', false)->get();
        $finishedOrders = Order::query()->where('finished', true)->get();

        return view('orders.index', [
            'activeOrders' => $activeOrders,
            'finishedOrders' => $finishedOrders,
        ]);
    }

    public function create(): View
    {
        $sales = $this->saleService->getSalesWithoutOrder();
        return view('orders.create', ['sales' => $sales]);
    }

    public function finish(Order $order): RedirectResponse
    {
        $order->update(['finished' => true]);

        return redirect()->route('orders.index');
    }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    public function store(Request $request): RedirectResponse
    {
        $orderData = OrderDTO::fromRequest($request);
        $this->orderService->storeOrder($orderData);
        return redirect()->route('orders.index');
    }

    public function show(Order $order): View
    {
        return view('orders.show', ['order' => $order]);
    }

    public function edit(Order $order): View
    {
        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $order->update($request->all());
        return redirect()->route('orders.index');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('orders.index');
    }
}
