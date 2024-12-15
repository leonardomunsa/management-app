@extends('layouts.app')

@section('title', 'Sale Details')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-gray-700 text-center">Sale Details</h1>

        <div class="space-y-4">
            <!-- Details -->
            <div>
                <h2 class="font-semibold">Details:</h2>
                <p class="bg-gray-100 p-3 rounded-lg break-words">
                    {{ $sale->details }}
                </p>
            </div>

            <!-- Amount -->
            <div>
                <h2 class="font-semibold">Amount:</h2>
                <p class="bg-gray-100 p-3 rounded-lg">
                    R${{ number_format($sale->amount, 2) }}
                </p>
            </div>

            <!-- Client -->
            <div>
                <h2 class="font-semibold">Client:</h2>
                <p class="bg-gray-100 p-3 rounded-lg">
                    {{ $sale->client->cnpj }} {{ $sale->client->name }}
                </p>
            </div>

            <!-- Paid Status -->
            <div>
                <h2 class="font-semibold">Paid:</h2>
                <p class="bg-gray-100 p-3 rounded-lg">
                    {{ $sale->paid ? 'Yes' : 'No' }}
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex space-x-4">
                <a href="{{ route('sales.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg">
                    Back to List
                </a>
                <a href="{{ route('sales.edit', $sale) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg">
                    Edit Sale
                </a>
            </div>
        </div>
    </div>
@endsection
