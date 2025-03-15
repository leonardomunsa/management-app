<?php

namespace App\Http\Controllers;

use App\DTO\SaleDTO;
use App\Models\Sale;
use App\Services\ClientService;
use App\Services\SaleService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function __construct(protected SaleService $saleService, protected ClientService $clientService)
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $sales = Sale::where('user_id', auth()->id())->get();
        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $this->authorize('create', Sale::class);
        $clients = $this->clientService->getClients(auth()->id());
        return view('sales.create', compact('clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $saleDTO = SaleDTO::fromRequest($request);
        $saleDTO->user_id = auth()->id();
        $this->saleService->storeSale($saleDTO);
        return redirect()->route('sales.index');
    }

    public function show(Sale $sale): View
    {
        $this->authorize('view', $sale);
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale): View
    {
        $this->authorize('update', $sale);
        return view('sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale): RedirectResponse
    {
        $this->authorize('update', $sale);
        $sale->update($request->all());
        return redirect()->route('sales.index');
    }

    public function markAsPaid(Sale $sale): RedirectResponse
    {
        $this->authorize('markAsPaid', $sale);
        $sale->update(['paid' => true]);
        return redirect()->back();
    }

    public function destroy(Sale $sale): RedirectResponse
    {
        $this->authorize('delete', $sale);
        $sale->delete();
        return redirect()->route('sales.index');
    }
}
