<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index');
    }

    public function create()
    {
        return redirect()->route('sales.index');
    }

    public function store(Request $request)
    {

        Sale::create($request->all());
        return redirect()->route('sales.index');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', ['sale' => $sale]);
    }

    public function edit(Sale $sale)
    {
        return view('sales.edit', ['sale' => $sale]);
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
