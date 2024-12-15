@extends('layouts.app')

@section('title', 'Create New Order')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Create New Order</h1>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-6" id="order-form">
            @csrf

            <!-- Order Number Field -->
            <div>
                <label for="number" class="block text-gray-700 font-semibold mb-2">Order Number</label>
                <input
                    type="text"
                    name="number"
                    id="number"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Enter order number"
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
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    required
                >
            </div>

            <!-- Sales Selection Field with Dropdown -->
            <div class="relative">
                <label for="select" class="block text-gray-700 font-semibold mb-2">Select Sales</label>
                <button
                    type="button"
                    id="dropdownButton"
                    class="w-full p-3 border border-gray-300 rounded-lg bg-white text-left flex justify-between items-center"
                    onclick="toggleDropdown()"
                >
                    <span>Select Sales</span>
                    <span>&#9662;</span>
                </button>
                <div id="dropdownMenu" class="hidden absolute w-full bg-white border border-gray-300 rounded-lg mt-2 max-h-60 overflow-y-auto z-10">
                    @foreach ($sales as $sale)
                        <div class="flex items-center p-3 hover:bg-gray-100 cursor-pointer" onclick="toggleCheckbox('sale-{{ $sale->uuid }}')">
                            <input
                                type="checkbox"
                                name="sales[]"
                                id="sale-{{ $sale->uuid }}"
                                value="{{ $sale->uuid }}"
                                class="mr-2"
                                data-amount="{{ $sale->amount }}"
                                onchange="updateTotalAmount()"
                            >
                            <label for="sale-{{ $sale->uuid }}" class="w-full cursor-pointer">
                                <span class="font-bold">{{ $sale->client->name }}</span> -
                                <span>{{ $sale->details }}</span> -
                                <span class="text-green-500">${{ number_format($sale->amount, 2) }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Amount Field (Read-Only) -->
            <div>
                <label for="amount" class="block text-gray-700 font-semibold mb-2">Total Amount</label>
                <input
                    type="text"
                    id="amount"
                    name="amount"
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100"
                    value="0.00"
                    readonly
                >
            </div>

            <!-- Finished Checkbox -->
            <div class="flex items-center">
                <input
                    type="checkbox"
                    name="finished"
                    id="finished"
                    class="mr-2"
                >
                <label for="finished" class="text-gray-700 font-semibold">Finished</label>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 cursor-not-allowed"
                    id="submit-button"
                    disabled
                >
                    Save Order
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        }

        function toggleCheckbox(id) {
            const checkbox = document.getElementById(id);
            checkbox.checked = !checkbox.checked;
            updateTotalAmount();
        }

        function updateTotalAmount() {
            const checkboxes = document.querySelectorAll('input[name="sales[]"]:checked');
            const amountInput = document.getElementById('amount');
            const submitButton = document.getElementById('submit-button');

            let totalAmount = 0;

            checkboxes.forEach(checkbox => {
                totalAmount += parseFloat(checkbox.getAttribute('data-amount'));
            });

            amountInput.value = totalAmount.toFixed(2);

            // Enable the submit button only if the total amount is >= 1500
            if (totalAmount >= 1500) {
                submitButton.disabled = false;
                submitButton.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                submitButton.classList.add('bg-blue-500', 'text-white', 'hover:bg-blue-600', 'cursor-pointer');
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove('bg-blue-500', 'text-white', 'hover:bg-blue-600', 'cursor-pointer');
                submitButton.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (event) => {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const dropdownButton = document.getElementById('dropdownButton');
            if (!dropdownMenu.contains(event.target) && !dropdownButton.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
@endsection
