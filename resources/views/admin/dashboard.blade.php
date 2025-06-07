@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Cards de Estatísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-500 bg-opacity-20 text-blue-400">
                    <i data-feather="dollar-sign" class="w-6 h-6"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-400">Receita Total</p>
                    <p class="text-2xl font-bold text-white">R$ 12.345,67</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-20 text-green-400">
                    <i data-feather="shopping-cart" class="w-6 h-6"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-400">Pedidos Pagos</p>
                    <p class="text-2xl font-bold text-white">1.234</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
             <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20 text-yellow-400">
                    <i data-feather="gift" class="w-6 h-6"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-400">Rifas Ativas</p>
                    <p class="text-2xl font-bold text-white">12</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
             <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-500 bg-opacity-20 text-indigo-400">
                    <i data-feather="users" class="w-6 h-6"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-400">Utilizadores</p>
                    <p class="text-2xl font-bold text-white">345</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico e Tabela de Pedidos Recentes -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Vendas nos Últimos 7 Dias</h3>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-white mb-4">Pedidos Recentes</h3>
            <div class="space-y-4">
                <!-- Exemplo de pedido -->
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-white">Pedido #1234</p>
                        <p class="text-sm text-gray-400">João da Silva</p>
                    </div>
                    <div class="text-right">
                         <p class="font-semibold text-green-400">R$ 50,00</p>
                         <p class="text-sm text-gray-500">Pago</p>
                    </div>
                </div>
                <hr class="border-gray-700">
                <!-- Outros pedidos... -->
            </div>
        </div>
    </div>

<script>
    // Dados de exemplo para o gráfico
    const labels = ['Dia 1', 'Dia 2', 'Dia 3', 'Dia 4', 'Dia 5', 'Dia 6', 'Dia 7'];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Receita',
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: 'rgba(59, 130, 246, 1)',
            data: [120, 150, 100, 200, 180, 250, 220],
            fill: true,
            tension: 0.4
        }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, grid: { color: '#374151' } },
                x: { grid: { display: false } }
            }
        }
    };
    new Chart(document.getElementById('salesChart'), config);
</script>
@endsection

