@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow space-y-4">
        <h1 class="text-2xl font-bold text-gray-700">Login</h1>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu email"
                    required
                >
            </div>
            <div>
                <label for="password" class="block font-semibold text-gray-700 mb-1">Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite sua senha"
                    required
                >
            </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-1">
                    <span class="text-gray-700">Lembrar-me</span>
                </label>
                <a href="#" class="text-sm text-blue-500 hover:underline">Esqueceu sua senha?</a>
            </div>
            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Entrar
                </button>
                <a href="{{ route('register.form') }}"
                   class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Registrar
                </a>
            </div>
        </form>
    </div>
@endsection
