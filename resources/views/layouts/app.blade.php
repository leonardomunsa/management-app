<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
<div class="container mx-auto p-6">
    <nav class="flex justify-between items-center mb-6">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">Gerenciamento App</a>
        <div class="flex space-x-4">
            <a href="{{ url('/dashboard') }}" class="text-blue-500 hover:underline">Dashboard</a>
            <a href="{{ url('/orders') }}" class="text-blue-500 hover:underline">Orders</a>
            <a href="{{ url('/sales') }}" class="text-blue-500 hover:underline">Sales</a>
            <a href="{{ url('/clients') }}" class="text-blue-500 hover:underline">Clients</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="mt-10 text-center text-gray-500">
        &copy; {{ date('Y') }} Gerenciamento App
    </footer>
</div>
</body>
</html>
