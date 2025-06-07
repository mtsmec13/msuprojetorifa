<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use App\Models\Compra;

class PublicRifaController extends Controller
{
    public function index()
    {
        $rifas = Rifa::orderBy('created_at', 'desc')->get();
        return view('public.rifas.index', compact('rifas'));
    }

    public function show(Rifa $rifa)
    {
        // Pega todas as compras relacionadas a essa rifa
        $compras = $rifa->compras()->get();

        // Monta array de todos os números ocupados (pegando do campo JSON)
        $numerosOcupados = [];
        foreach ($compras as $compra) {
            $numeros = json_decode($compra->numeros_escolhidos, true);
            if (is_array($numeros)) {
                $numerosOcupados = array_merge($numerosOcupados, $numeros);
            }
        }

        // Gera os vencedores como antes
        $vencedores = [];
        for ($i=1; $i<=3; $i++) {
            $num = $rifa->{'numero_sorteado_'.$i};
            $premio = $rifa->{'premio_'.$i};
            // Busca o ganhador pelo número dentro do array de números escolhidos
            $ganhador = null;
            foreach ($compras as $compra) {
                $numeros = json_decode($compra->numeros_escolhidos, true);
                if (is_array($numeros) && in_array($num, $numeros)) {
                    $ganhador = $compra;
                    break;
                }
            }
            if ($num && $premio) {
                $vencedores[] = [
                    'colocacao' => $i,
                    'numero' => $num,
                    'premio' => $premio,
                    'nome' => $ganhador ? $ganhador->nome_comprador : null,
                    'whatsapp' => $ganhador ? $ganhador->telefone : null,
                ];
            }
        }

        return view('public.rifas.show', compact('rifa', 'vencedores', 'numerosOcupados'));
    }
    
    public function ranking()
    {
        $ranking = \DB::table('compras')
            ->select('nome_comprador', 'telefone', \DB::raw('count(*) as total_compras'))
            ->groupBy('nome_comprador', 'telefone')
            ->orderByDesc('total_compras')
            ->limit(50)
            ->get();

        return view('public.rifas.ranking', compact('ranking'));
    }
}