<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Compra;
use App\Models\Rifa;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas principais
        $totalUsuarios = User::count();
        $totalBilhetes = Compra::count();
        $totalSorteios = Rifa::where('status', 'ativa')->count();
        $totalFaturamento = Compra::where('status', 'aprovado')->sum('valor_pago');
        $saldoConta = optional(auth()->user())->saldo ?? 0;

        // Sorteio em destaque
        $sorteioDestaque = Rifa::where('status', 'ativa')->orderByDesc('created_at')->first();

        // Sorteios disponíveis
        $sorteiosDisponiveis = Rifa::where('status', 'ativa')->get();

        // Últimos sorteios finalizados
        $ultimosSorteios = Rifa::where('status', 'finalizada')->orderByDesc('updated_at')->limit(2)->get();

        return view('dashboard', [
            'totalUsuarios' => $totalUsuarios,
            'totalBilhetes' => $totalBilhetes,
            'totalSorteios' => $totalSorteios,
            'totalFaturamento' => $totalFaturamento,
            'saldoConta' => $saldoConta,
            'sorteioDestaque' => $sorteioDestaque,
            'sorteiosDisponiveis' => $sorteiosDisponiveis,
            'ultimosSorteios' => $ultimosSorteios,
        ]);
    }
}