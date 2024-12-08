<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-wider">
<nav class="bg-blue-500 p-4 text-white">
    <div class="container mx-auto">
        <a href="{{ url('/') }}" class="text-2xl font-bold">My Laravel App</a>
    </div>
</nav>

<main class="container mx-auto mt-10">
    @yield('content')
</main>

<footer class="bg-blue-500 p-4 mt-10 text-white text-center">
    &copy; {{ date('Y') }} My Laravel App
</footer>
</body>
</html>
