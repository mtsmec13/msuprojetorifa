<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - {{ config('app.name', 'RifaApp') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/css/phosphor.css">
    @stack('head')
</head>
<body class="bg-gray-900 text-gray-100 antialiased min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-800 flex flex-col py-8 px-4 min-h-screen">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-yellow-400 mb-12">Admin</a>
        <nav class="flex-1 space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-chart-bar text-xl"></i> Dashboard
            </a>
            <a href="{{ route('admin.rifas') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.rifas') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-ticket text-xl"></i> Rifas
            </a>
            <a href="{{ route('admin.usuarios') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.usuarios') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-users text-xl"></i> Usuários
            </a>
            <a href="{{ route('admin.compras') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.compras') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-shopping-cart text-xl"></i> Compras
            </a>
            <a href="{{ route('admin.configuracoes') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.configuracoes') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-gear text-xl"></i> Configurações
            </a>
            <a href="{{ route('admin.gateway') }}" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.gateway') ? 'bg-gray-700' : '' }}">
                <i class="ph ph-credit-card text-xl"></i> Gateway
            </a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="mt-10">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 p-2 rounded hover:bg-red-700 text-red-300">
                <i class="ph ph-sign-out"></i> Sair
            </button>
        </form>
    </aside>

    <main class="flex-1 px-8 py-8">
        @yield('content')
    </main>
</body>
</html>