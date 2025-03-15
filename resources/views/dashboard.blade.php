@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen max-w-7xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-lg">
        <!-- Navbar de Links -->
        <div class="flex justify-end mb-6 space-x-5">
            <a href="{{ route('orders.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                View Orders
            </a>
            <a href="{{ route('clients.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
                View Clients
            </a>
            <a href="{{ route('sales.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded-lg">
                View Sales
            </a>
        </div>

        <!-- Título com o nome do usuário -->
        <h1 class="text-4xl font-bold mb-6 text-gray-700">Welcome, {{ auth()->user()->name ?? 'User' }}</h1>

        <!-- Orders Section -->
        <div>
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Recent Orders</h2>
            @forelse ($orders as $order)
                <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden mb-4">
                    <div
                        class="flex justify-between items-center p-4 cursor-pointer bg-gray-100 hover:bg-gray-200"
                        onclick="toggleDropdown('order-{{ $order->number }}')">
                        <span class="text-gray-700 font-semibold">
                            Pedido #{{ $order->number }} - {{ $order->date }}
                        </span>
                        <span class="text-gray-700">
                            &#9660;
                        </span>
                    </div>

                    <div id="order-{{ $order->number }}" class="hidden bg-gray-50">
                        @foreach ($order->sales as $sale)
                            <div class="flex justify-between items-center border-b p-4">
                                <div class="w-2/3">
                                    <span class="text-gray-600 font-semibold truncate block">{{ $sale->client->name }}</span>
                                    <span class="text-gray-500 truncate block">{{ $sale->details }}</span>
                                </div>
                                <div class="flex items-center space-x-4 w-1/3 justify-end">
                                    <span class="text-green-500 font-bold min-w-[100px] text-right">${{ number_format($sale->amount, 2) }}</span>
                                    @if ($sale->paid)
                                        <div class="flex items-center space-x-1">
                                            <input type="checkbox" checked disabled class="h-4 w-4">
                                            <span class="text-gray-600 font-semibold">Paid</span>
                                        </div>
                                    @else
                                        <form action="{{ route('sales.markAsPaid', $sale) }}" method="POST" class="flex items-center space-x-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="checkbox" class="h-4 w-4" onchange="this.form.submit()">
                                            <span class="text-blue-500 font-semibold">Paid</span>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-between items-center p-4 bg-gray-100 font-bold">
                            <span class="text-gray-700">Total:</span>
                            <span class="text-blue-500">${{ number_format($order->amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No recent orders available.</p>
            @endforelse
        </div>

        <!-- Sales and Clients Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <!-- Latest Sales -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Latest Sales</h2>
                <ul>
                    @forelse ($sales as $sale)
                        <li class="border-b py-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 truncate block w-48">{{ \Illuminate\Support\Str::limit($sale->details, 40) }}</span>
                                <span class="text-green-500 font-bold">${{ number_format($sale->amount, 2) }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-500">No recent sales available.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Recent Clients -->
            <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Recent Clients</h2>
                <ul>
                    @forelse ($clients as $client)
                        <li class="border-b py-2">
                            <div class="text-gray-600">{{ $client->name }}</div>
                        </li>
                    @empty
                        <li class="text-gray-500">No recent clients available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');
        }
    </script>
@endsection
