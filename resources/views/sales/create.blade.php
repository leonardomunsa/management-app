@extends('layouts.app')

@section('title', 'Create New Sale')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Create New Sale</h1>

        <form action="{{ route('sales.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Client Selection -->
            <div>
                <label for="client" class="block text-gray-700 font-semibold mb-2">Select Client</label>
                <select
                    name="clientUuid"
                    id="client"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
                    <option value="">-- Select a Client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->uuid }}">{{ $client->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Details Field -->
            <div>
                <label for="details" class="block text-gray-700 font-semibold mb-2">Details</label>
                <textarea
                    name="details"
                    id="details"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    rows="4"
                    placeholder="Enter sale details"
                    required
                ></textarea>
            </div>

            <!-- Amount Field -->
            <div>
                <label for="amount" class="block text-gray-700 font-semibold mb-2">Amount</label>
                <input
                    type="number"
                    step="0.01"
                    name="amount"
                    id="amount"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Enter sale amount"
                    required
                >
            </div>

            <!-- Paid Checkbox -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="paid"
                    id="paid"
                    class="h-5 w-5 text-blue-500"
                >
                <label for="paid" class="ml-2 text-gray-700 font-semibold">Paid</label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300"
                >
                    Save Sale
                </button>
            </div>
        </form>
    </div>
@endsection
