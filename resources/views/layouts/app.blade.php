<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Ícones (Feather Icons) -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
        }
    </style>
</head>
<body class="antialiased">

    <!-- CABEÇALHO -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center space-x-2">
                    <i data-feather="star" class="text-blue-500 h-7 w-7"></i>
                    <span class="text-white font-bold text-xl">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Entrar</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-bold">Registar</a>
                    @else
                        <a href="{{ route('painel') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Meu Painel</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-bold">Sair</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- CONTEÚDO DA PÁGINA -->
    <main>
        {{-- ESTA É A CORREÇÃO --}}
        {{-- Verifica se $slot existe (para componentes) ou usa @yield (para views tradicionais) --}}
        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>

    <!-- RODAPÉ -->
    <footer class="border-t border-gray-800 mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Script para renderizar os ícones -->
    <script>
        feather.replace();
    </script>
</body>
</html>

