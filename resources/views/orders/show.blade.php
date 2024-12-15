@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Order Details</h1>

        <div class="mb-4">
            <strong>Order Number:</strong> {{ $order->number }}
        </div>
        <div class="mb-4">
            <strong>Date:</strong> {{ $order->date }}
        </div>
        <div class="mb-4">
            <strong>Amount:</strong> {{ $order->amount }}
        </div>
        <div class="mb-4">
            <strong>Finished:</strong> {{ $order->finished ? 'Yes' : 'No' }}
        </div>

        <div class="flex justify-between">
            <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
            <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Edit Order
            </a>
        </div>
    </div>
@endsection
