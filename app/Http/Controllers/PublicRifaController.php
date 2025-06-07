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
        $compras = $rifa->compras()->orderBy('numero')->get();
        $vencedores = [];
        for ($i=1; $i<=3; $i++) {
            $num = $rifa->{'numero_sorteado_'.$i};
            $premio = $rifa->{'premio_'.$i};
            $ganhador = $num ? $compras->where('numero', $num)->first() : null;
            if ($num && $premio) {
                $vencedores[] = [
                    'colocacao' => $i,
                    'numero' => $num,
                    'premio' => $premio,
                    'nome' => $ganhador ? $ganhador->nome : null,
                    'whatsapp' => $ganhador ? $ganhador->whatsapp : null,
                ];
            }
        }
        return view('public.rifas.show', compact('rifa', 'vencedores'));
    }
    
    public function ranking()
    {
        $ranking = \DB::table('compras')
            ->select('nome', 'whatsapp', \DB::raw('count(*) as total_compras'))
            ->groupBy('nome', 'whatsapp')
            ->orderByDesc('total_compras')
            ->limit(50)
            ->get();

        return view('public.rifas.ranking', compact('ranking'));
    }

}