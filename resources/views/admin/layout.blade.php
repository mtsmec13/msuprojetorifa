
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 text-xl font-bold border-b">Painel Admin</div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="home" class="w-4 h-4 mr-2"></i>Dashboard</a></li>
                <li><a href="{{ route('admin.rifas.index') }}" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="grid" class="w-4 h-4 mr-2"></i>Rifas</a></li>
                <li><a href="{{ route('admin.gateways.index') }}" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>Gateways</a></li>
                <li><a href="#" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="gift" class="w-4 h-4 mr-2"></i>Cupons</a></li>
                <li><a href="#" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="users" class="w-4 h-4 mr-2"></i>Usuários</a></li>
                <li><a href="#" class="flex items-center p-2 rounded hover:bg-gray-200"><i data-lucide="bar-chart" class="w-4 h-4 mr-2"></i>Relatórios</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 overflow-y-auto p-6">
        <header class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">@yield('title')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Olá, {{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-sm text-red-500 hover:underline">Sair</button></form>
            </div>
        </header>

        @yield('content')
    </main>
</div>

<script>lucide.createIcons();</script>
</body>
</html>
