@extends('layouts.app')

@section('title', 'Create New Client')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-700">Create New Client</h1>

        <form action="{{ route('clients.store') }}" method="POST" class="space-y-6" id="client-form">
            @csrf

            <!-- CNPJ Field -->
            <div>
                <label for="cnpj" class="block text-gray-700 font-semibold mb-2">CNPJ</label>
                <input
                    type="text"
                    name="cnpj"
                    id="cnpj"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter client CNPJ"
                    required
                    oninput="debouncedFetchCNPJData()"
                >
            </div>

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Client name"
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
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Client address"
                    required
                >
            </div>

            <!-- Number Field -->
            <div>
                <label for="number" class="block text-gray-700 font-semibold mb-2">Number</label>
                <input
                    type="text"
                    name="number"
                    id="number"
                    class="w-full p-3 border border-gray-300 rounded-lg"
                    placeholder="Client number"
                    required
                >
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300"
                >
                    Save Client
                </button>
            </div>
        </form>
    </div>

    <script>
        let apiUrl = '';

        async function fetchApiUrl() {
            try {
                const response = await fetch('/api/config/cnpj-url');
                const data = await response.json();
                apiUrl = data.url;
            } catch (error) {
                console.error('Error fetching API URL:', error.message);
                alert(`Error fetching API configuration: ${error.message}`);
            }
        }

        document.addEventListener('DOMContentLoaded', fetchApiUrl);

        let debounceTimeout;

        function debouncedFetchCNPJData() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(fetchCNPJData, 100);
        }

        async function fetchCNPJData() {
            const cnpjInput = document.getElementById('cnpj');
            const cnpj = cnpjInput.value.replace(/\D/g, '');

            if (cnpj.length !== 14 || !apiUrl) {
                return;
            }

            try {
                const response = await fetch(`${apiUrl}${cnpj}`);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                document.getElementById('name').value = data.company.name || '';
                document.getElementById('address').value = formatAddress(data.address) || '';
                document.getElementById('number').value = formatNumber(data.phones) || '';

            } catch (error) {
                console.error('Error fetching CNPJ data:', error.message);
                alert('Error fetching CNPJ data. Please try again.');
            }
        }

        function formatAddress(address) {
            return `${address.street}, ${address.district}, ${address.city} - ${address.state}, ${address.zip}`;
        }

        function formatNumber(phone) {
            [contact] = phone;
            return `(${contact.area}) ${contact.number}`;
        }
    </script>
@endsection
