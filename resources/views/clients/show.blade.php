@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">Client Details</h1>

        <p><strong>Name:</strong> {{ $client->name }}</p>
        <p><strong>CNPJ:</strong> {{ $client->cnpj }}</p>
        <p><strong>Address:</strong> {{ $client->address ?? 'N/A' }}</p>
        <p><strong>Number:</strong> {{ $client->number ?? 'N/A' }}</p>

        <div class="mt-6">
            <a href="{{ route('clients.index') }}" class="text-blue-500 hover:underline">Back to Clients List</a>
        </div>
    </div>
@endsection
