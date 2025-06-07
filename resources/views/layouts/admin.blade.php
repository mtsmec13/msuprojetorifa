<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Painel Admin - {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js para interatividade -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Ícones (Feather Icons) -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background-color: #0d1117; font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background-color: #1f2937; border-right: 3px solid #3b82f6; }
        [x-cloak] { display: none; }
    </style>
</head>
<body class="antialiased text-gray-200" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen bg-gray-900">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 px-4 py-7 overflow-y-auto bg-gray-800 border-r border-gray-700 sm:static sm:left-auto sm:z-auto sm:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-white">
                    <i data-feather="star" class="text-blue-500"></i>
                    <span class="text-2xl font-bold">{{ config('app.name') }}</span>
                </a>
                <button @click="sidebarOpen = false" class="sm:hidden">
                    <i data-feather="x"></i>
                </button>
            </div>

            <nav class="mt-10">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-4 py-2 mt-5 text-gray-300 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span class="mx-4 font-medium">Dashboard</span>
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-2 mt-5 text-gray-300 rounded-md hover:bg-gray-700 {{ request()->routeIs('admin.rifas.*') ? 'active' : '' }}">
                    <i data-feather="gift" class="w-5 h-5"></i>
                    <span class="mx-4 font-medium">Rifas</span>
                </a>
                 <a href="#" class="sidebar-link flex items-center px-4 py-2 mt-5 text-gray-300 rounded-md hover:bg-gray-700">
                    <i data-feather="shopping-cart" class="w-5 h-5"></i>
                    <span class="mx-4 font-medium">Pedidos</span>
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-2 mt-5 text-gray-300 rounded-md hover:bg-gray-700">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span class="mx-4 font-medium">Utilizadores</span>
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-2 mt-5 text-gray-300 rounded-md hover:bg-gray-700">
                    <i data-feather="settings" class="w-5 h-5"></i>
                    <span class="mx-4 font-medium">Configurações</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="flex justify-between items-center p-6 bg-gray-800 border-b border-gray-700">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="text-white sm:hidden">
                    <i data-feather="menu"></i>
                </button>
                <div class="text-xl font-semibold text-white">@yield('title', 'Dashboard')</div>
                
                <div class="flex items-center space-x-4">
                     <span class="text-gray-300">Olá, {{ Auth::user()->name }}</span>
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-400">
                           <i data-feather="log-out"></i>
                        </button>
                    </form>
                </div>
            </header>
            
            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-900 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>

