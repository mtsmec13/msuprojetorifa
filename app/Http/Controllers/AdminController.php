<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Compra;
use App\Models\Rifa;
use App\Models\Configuracao;
use App\Models\Gateway;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsuarios = User::count();
        $totalBilhetes = Compra::count();
        $totalFaturamento = Compra::where('status', 'aprovado')->sum('valor_pago');
        $totalSorteios = Rifa::count();

        $ultimosSorteios = Rifa::orderByDesc('created_at')->take(3)->get();
        $rifasAtivas = Rifa::where('status', 'ativa')->get();
        $maioresCompradores = User::withCount(['compras'])->orderByDesc('compras_count')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalBilhetes', 'totalFaturamento',
            'totalSorteios', 'ultimosSorteios', 'rifasAtivas', 'maioresCompradores'
        ));
    }

    public function rifas() {
        $rifas = Rifa::orderByDesc('created_at')->paginate(12);
        return view('admin.rifas', compact('rifas'));
    }

    public function usuarios() {
        $usuarios = User::orderBy('name')->paginate(20);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function compras() {
        $compras = Compra::with(['rifa', 'user'])->orderByDesc('created_at')->paginate(20);
        return view('admin.compras', compact('compras'));
    }

    public function configuracoes() {
        $config = Configuracao::first();
        return view('admin.configuracoes', compact('config'));
    }

    public function salvarConfiguracoes(Request $request) {
        $config = Configuracao::first() ?? new Configuracao();
        $config->nome_site = $request->nome_site;
        $config->email_suporte = $request->email_suporte;
        $config->tema = $request->tema;
        $config->save();
        return back()->with('sucesso', 'Configurações salvas!');
    }

    public function gateway() {
        $gateway = Gateway::first();
        return view('admin.gateway', compact('gateway'));
    }

    public function salvarGateway(Request $request) {
        $gateway = Gateway::first() ?? new Gateway();
        $gateway->tipo = $request->tipo;
        $gateway->chave = $request->chave;
        $gateway->token = $request->token;
        $gateway->save();
        return back()->with('sucesso', 'Gateway salvo!');
    }
}