@extends('layouts.dashboard')

@section('title', 'Orders')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-lg min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Orders</h1>

        <!-- Botões para Adicionar Novo Pedido e Tabs -->
        <div class="flex justify-between mb-6">
            <a href="{{ route('orders.create') }}"
               class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Add New Order
            </a>

            <div>
                <button id="active-tab-btn" class="px-4 py-2 bg-blue-500 text-white rounded-lg mr-2" onclick="showTab('active')">
                    Active Orders
                </button>
                <button id="finished-tab-btn" class="px-4 py-2 bg-gray-500 text-white rounded-lg" onclick="showTab('finished')">
                    Finished Orders
                </button>
            </div>
        </div>

        <!-- Active Orders -->
        <div id="active-orders" class="tab-content">
            @if($activeOrders->isEmpty())
                <p class="text-center text-gray-600">No active orders available.</p>
            @else
                <table class="w-full table-auto mb-6">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-4 text-center">Order Number</th>
                        <th class="px-4 py-4 text-center">Date</th>
                        <th class="px-4 py-4 text-center">Amount</th>
                        <th class="px-4 py-4 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activeOrders as $order)
                        <tr class="border-b">
                            <td class="px-4 py-4 text-center">{{ $order->number }}</td>
                            <td class="px-4 py-4 text-center">{{ $order->date }}</td>
                            <td class="px-4 py-4 text-center">${{ number_format($order->amount, 2) }}</td>
                            <td class="px-4 py-4 text-center">
                                <form action="{{ route('orders.finish', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <label class="flex justify-center items-center cursor-pointer">
                                        <input type="checkbox" class="mr-2" onchange="this.form.submit()"> Finalize
                                    </label>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Finished Orders -->
        <div id="finished-orders" class="tab-content hidden">
            @if($finishedOrders->isEmpty())
                <p class="text-center text-gray-600">No finished orders available.</p>
            @else
                <table class="w-full table-auto mb-6">
                    <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-4 text-center">Order Number</th>
                        <th class="px-4 py-4 text-center">Date</th>
                        <th class="px-4 py-4 text-center">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($finishedOrders as $order)
                        <tr class="border-b">
                            <td class="px-4 py-4 text-center">{{ $order->number }}</td>
                            <td class="px-4 py-4 text-center">{{ $order->date }}</td>
                            <td class="px-4 py-4 text-center">${{ number_format($order->amount, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <script>
        function showTab(tab) {
            const activeOrders = document.getElementById('active-orders');
            const finishedOrders = document.getElementById('finished-orders');
            const activeBtn = document.getElementById('active-tab-btn');
            const finishedBtn = document.getElementById('finished-tab-btn');

            if (tab === 'active') {
                activeOrders.classList.remove('hidden');
                finishedOrders.classList.add('hidden');
                activeBtn.classList.add('bg-blue-500');
                activeBtn.classList.remove('bg-gray-500');
                finishedBtn.classList.remove('bg-blue-500');
                finishedBtn.classList.add('bg-gray-500');
            } else {
                activeOrders.classList.add('hidden');
                finishedOrders.classList.remove('hidden');
                finishedBtn.classList.add('bg-blue-500');
                finishedBtn.classList.remove('bg-gray-500');
                activeBtn.classList.remove('bg-blue-500');
                activeBtn.classList.add('bg-gray-500');
            }
        }
    </script>
@endsection
