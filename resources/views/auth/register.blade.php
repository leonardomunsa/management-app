@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow space-y-4">
        <h1 class="text-2xl font-bold text-gray-700">Registrar</h1>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nome -->
            <div>
                <label for="name" class="block font-semibold text-gray-700 mb-1">Nome</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu nome"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-semibold text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu email"
                    required
                >
            </div>

            <!-- Senha -->
            <div>
                <label for="password" class="block font-semibold text-gray-700 mb-1">Senha</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <!-- Confirmação de Senha -->
            <div>
                <label for="password_confirmation" class="block font-semibold text-gray-700 mb-1">Confirmar Senha</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full border border-gray-300 rounded p-2 focus:ring-2 focus:ring-blue-400"
                    placeholder="Confirme sua senha"
                    required
                >
            </div>

            <!-- Botão Registrar + Link Login -->
            <div class="flex items-center justify-between pt-2">
                <button
                    type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                >
                    Registrar
                </button>
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                    Já possui conta? Login
                </a>
            </div>
        </form>

        @if($errors->any())
            <div class="mt-4">
                @foreach($errors->all() as $error)
                    <p class="text-red-500 text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
@endsection
