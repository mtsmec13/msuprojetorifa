<?php

// O namespace foi atualizado para organizar melhor o painel
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pedido; // Supondo que 'Compra' agora é 'Pedido'
use App\Models\Rifa;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Exibe o painel administrativo principal com as estatísticas do sistema.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // --- PRESERVAÇÃO DA SUA LÓGICA DE NEGÓCIO ---
        // As suas consultas foram mantidas e adaptadas para o novo painel.

        // Estatísticas para os cards principais
        $receitaTotal = Pedido::where('status', 'pago')->sum('valor_total');
        $pedidosPagos = Pedido::where('status', 'pago')->count();
        $rifasAtivasCount = Rifa::where('status', 'Ativo')->count();
        $utilizadoresCount = User::count();

        // Dados para as tabelas e gráficos do dashboard
        $ultimosPedidos = Pedido::with('rifa', 'user')->where('status', 'pago')->latest()->limit(5)->get();

        // Você pode adicionar mais lógicas aqui, como dados para o gráfico de vendas.
        // Exemplo:
        // $vendasUltimos7Dias = Pedido::where('status', 'pago')
        //     ->where('created_at', '>=', now()->subDays(7))
        //     ->selectRaw('DATE(created_at) as data, SUM(valor_total) as total')
        //     ->groupBy('data')
        //     ->orderBy('data', 'asc')
        //     ->pluck('total', 'data');
        
        // Envia todas as variáveis para a view do dashboard
        return view('admin.dashboard', compact(
            'receitaTotal',
            'pedidosPagos',
            'rifasAtivasCount',
            'utilizadoresCount',
            'ultimosPedidos'
            // 'vendasUltimos7Dias'
        ));
    }
}

  