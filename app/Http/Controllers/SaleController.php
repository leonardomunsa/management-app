<?php

namespace App\Http\Controllers;

use App\DTO\SaleDTO;
use App\Models\Sale;
use App\Services\ClientService;
use App\Services\SaleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function __construct(protected SaleService $saleService, protected ClientService $clientService)
    {
    }

    public function index(): View
    {
        $sales = Sale::all();
        return view('sales.index', ['sales' => $sales]);
    }

    public function create(): View
    {
        $clients = $this->clientService->getClients();
        return view('sales.create', compact('clients'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $sale = SaleDTO::fromRequest($request);

        $this->saleService->storeSale($sale);

        return redirect()->route('sales.index');
    }

    public function show(Sale $sale): View
    {
        return view('sales.show', ['sale' => $sale]);
    }

    public function edit(Sale $sale): View
    {
        return view('sales.edit', ['sale' => $sale]);
    }

    public function update(Request $request, Sale $sale): RedirectResponse
    {
        $sale->update($request->all());
        return redirect()->route('sales.index');
    }

    public function markAsPaid(Sale $sale): RedirectResponse
    {
        $sale->update(['paid' => true]);
        return redirect()->back();
    }

    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->delete();
        return redirect()->route('sales.index');
    }
}
