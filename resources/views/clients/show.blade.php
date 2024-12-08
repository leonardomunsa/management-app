@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Client Details</h1>

        <div class="mb-4">
            <strong>Name:</strong> {{ $client->name }}
        </div>
        <div class="mb-4">
            <strong>CNPJ:</strong> {{ $client->cnpj }}
        </div>
        <div class="mb-4">
            <strong>Address:</strong> {{ $client->address }}
        </div>
        <div class="mb-4">
            <strong>Number:</strong> {{ $client->number }}
        </div>

        <div class="flex justify-between">
            <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
            <a href="{{ route('clients.edit', $client) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Edit Client
            </a>
        </div>
    </div>
@endsection
