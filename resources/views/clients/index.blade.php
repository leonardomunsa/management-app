@extends('layouts.app')

@section('title', 'Clients')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Clients List</h1>

    @if($clients->isEmpty())
        <p>No clients found.</p>
    @else
        <ul>
            @foreach ($clients as $client)
                <li class="mb-2">
                    <strong>{{ $client->name }}</strong> – {{ $client->number }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
