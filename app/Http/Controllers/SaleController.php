<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return Inertia::render('Sales/Index', [
            'sales' => $sales,
        ]);
    }

    public function create()
    {
        return Inertia::render('Sales/Create');
    }

    public function store(Request $request)
    {
        Sale::create($request->all());
        return redirect()->route('sales.index');
    }

    public function show(Sale $sale)
    {
        return Inertia::render('Sales/Show', [
            'sale' => $sale,
        ]);
    }

    public function edit(Sale $sale)
    {
        return Inertia::render('Sales/Edit', [
            'sale' => $sale,
        ]);
    }

    public function update(Request $request, Sale $sale)
    {
        $sale->update($request->all());
        return redirect()->route('sales.index');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index');
    }
}
