<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'RifaApp') }}</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Phosphor Icons CDN -->
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/css/phosphor.css">
    <!-- Favicon opcional -->
    <link rel="icon" type="image/png" href="/favicon.png">
    @stack('head')
</head>
<body class="bg-gray-900 text-gray-100 antialiased min-h-screen flex flex-col">

    {{-- Navbar simples --}}
    <nav class="bg-gray-800 py-3 px-6 flex justify-between items-center shadow-lg">
        <a href="{{ url('/') }}" class="text-2xl font-bold tracking-tight text-yellow-400">
            {{ config('app.name', 'RifaApp') }}
        </a>
        <div class="space-x-4">
            @auth
                <span class="text-gray-300">Olá, {{ auth()->user()->name }}</span>
                <a href="{{ route('dashboard') }}" class="hover:text-yellow-400">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-red-400">Sair</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-yellow-400">Entrar</a>
                <a href="{{ route('register') }}" class="hover:text-yellow-400">Registrar</a>
            @endauth
        </div>
    </nav>

    {{-- Mensagens flash --}}
    <div class="container mx-auto mt-4">
        @if(session('sucesso'))
            <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">{{ session('sucesso') }}</div>
        @endif
        @if(session('erro'))
            <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">{{ session('erro') }}</div>
        @endif
    </div>

    {{-- Conteúdo principal --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Rodapé simples --}}
    <footer class="bg-gray-800 text-gray-400 py-3 mt-10 text-center">
        &copy; {{ date('Y') }} {{ config('app.name', 'RifaApp') }}. Todos os direitos reservados.
    </footer>

    @stack('scripts')
</body>
</html>