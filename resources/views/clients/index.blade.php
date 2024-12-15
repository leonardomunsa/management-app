@extends('layouts.app')

@section('title', 'Clients List')

@section('content')
    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md min-h-screen">
        <h1 class="text-3xl font-bold mb-4">Clients List</h1>

        <!-- Botão de Adicionar Cliente -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded flex items-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Client
            </a>
        </div>

        <!-- Lista de Clientes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach ($clients as $client)
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h2 class="text-xl font-semibold">{{ $client->name }}</h2>
                    <p class="text-gray-600">{{ $client->cnpj }}</p>

                    <!-- Botões de Ação -->
                    <div class="flex mt-4 space-x-4">
                        <a href="{{ route('clients.show', $client) }}" class="text-blue-500 hover:underline flex items-center">
                            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m6 0H9m6 0H9"></path>
                            </svg>
                            View
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="text-yellow-500 hover:underline flex items-center">
                            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline flex items-center" onclick="return confirm('Are you sure?')">
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
