@extends('layouts.app')

@section('title', 'Clients List')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Clients List</h1>

        <div class="mb-4">
            <a href="{{ route('clients.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Create New Client
            </a>
        </div>

        <table class="w-full table-auto bg-white border-collapse">
            <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">CNPJ</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($clients as $client)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $client->name }}</td>
                    <td class="border px-4 py-2">{{ $client->cnpj }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('clients.show', $client) }}" class="text-blue-500 hover:underline mr-2">View</a>
                        <a href="{{ route('clients.edit', $client) }}" class="text-yellow-500 hover:underline mr-2">Edit</a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
