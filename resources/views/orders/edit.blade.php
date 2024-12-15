@extends('layouts.app')

@section('title', 'Edit Order')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Edit Order</h1>

        <form action="{{ route('orders.update', $order) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Order Number Field -->
            <div>
                <label for="number" class="block text-gray-700 font-semibold mb-2">Order Number</label>
                <input
                    type="text"
                    name="number"
                    id="number"
                    value="{{ $order->number }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block text-gray-700 font-semibold mb-2">Date</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    value="{{ $order->date }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- Amount Field -->
            <div>
                <label for="amount" class="block text-gray-700 font-semibold mb-2">Amount</label>
                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    id="amount"
                    value="{{ $order->amount }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- Finished Checkbox -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="finished"
                    id="finished"
                    {{ $order->finished ? 'checked' : '' }}
                    class="mr-2"
                >
                <label for="finished" class="text-gray-700 font-semibold">Finished</label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg"
                >
                    Update Order
                </button>
            </div>
        </form>
    </div>
@endsection
