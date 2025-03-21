<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased">
<!-- Container que ocupa a tela toda em colunas -->
<div class="flex flex-col min-h-screen">

    <!-- Cabeçalho / Nav -->
    <header class="p-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">Gerenciamento App</a>
            <div class="flex space-x-4">
                <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Dashboard</a>
                <a href="{{ url('/orders') }}" class="text-blue-500 hover:underline">Orders</a>
                <a href="{{ url('/sales') }}" class="text-blue-500 hover:underline">Sales</a>
                <a href="{{ url('/clients') }}" class="text-blue-500 hover:underline">Clients</a>

                <!-- Formulário de Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Área principal que cresce e centraliza o conteúdo -->
    <main class="flex-grow flex items-center justify-center">
        <!-- Outro container para controlar a largura do conteúdo -->
        <div class="container mx-auto p-6 max-w-md">
            @yield('content')
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="p-6 text-center text-gray-500">
        <div class="container mx-auto">
            &copy; {{ date('Y') }} Gerenciamento App
        </div>
    </footer>
</div>
</body>
</html>
