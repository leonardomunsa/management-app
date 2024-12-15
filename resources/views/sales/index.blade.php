@extends('layouts.app')

@section('title', 'Sales List')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4 text-gray-700">Sales List</h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('sales.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Sale
            </a>
        </div>

        <table class="w-full bg-white rounded-lg shadow-md">
            <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4">Details</th>
                <th class="py-2 px-4">Amount</th>
                <th class="py-2 px-4">Client</th>
                <th class="py-2 px-4">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sales as $sale)
                <tr class="border-b">
                    <td class="py-2 px-4 max-w-xs truncate">
                        <div class="w-48 overflow-hidden overflow-ellipsis whitespace-nowrap">
                            {{ $sale->details }}
                        </div>
                    </td>
                    <td class="py-2 px-4">R${{ number_format($sale->amount, 2) }}</td>
                    <td class="py-2 px-4">{{ $sale->client->name }}</td>
                    <td class="py-2 px-4 flex items-center space-x-4">
                        <a href="{{ route('sales.show', $sale) }}" class="text-blue-500 hover:underline">View</a>
                        <form action="{{ route('sales.markAsPaid', $sale) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('PATCH')
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" class="form-checkbox" onchange="this.form.submit()" {{ $sale->paid ? 'checked disabled' : '' }}>
                                <span class="text-green-500">{{ $sale->paid ? 'Paid' : 'Mark as Paid' }}</span>
                            </label>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
