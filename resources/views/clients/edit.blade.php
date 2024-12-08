@extends('layouts.app')

@section('title', 'Edit Client')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Edit Client</h1>

        <form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ $client->name }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- CNPJ Field -->
            <div>
                <label for="cnpj" class="block text-gray-700 font-semibold mb-2">CNPJ</label>
                <input
                    type="text"
                    name="cnpj"
                    id="cnpj"
                    value="{{ $client->cnpj }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- Address Field -->
            <div>
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                <input
                    type="text"
                    name="address"
                    id="address"
                    value="{{ $client->address }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                >
            </div>

            <!-- Number Field -->
            <div>
                <label for="number" class="block text-gray-700 font-semibold mb-2">Number</label>
                <input
                    type="text"
                    name="number"
                    id="number"
                    value="{{ $client->number }}"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                >
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg"
                >
                    Update Client
                </button>

                <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
