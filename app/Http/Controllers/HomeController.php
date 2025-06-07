<?php

namespace App\Http\Controllers;

use App\Models\Rifa;

class HomeController extends Controller
{
    public function index()
    {
        $rifas = Rifa::orderBy('created_at', 'desc')->get();

        // Rifas do banner (ativas e marcadas)
        $banners = Rifa::where('mostrar_banner', 1)
            ->where(function($q){
                $q->whereNull('numero_sorteado_1')
                    ->whereNull('numero_sorteado_2')
                    ->whereNull('numero_sorteado_3');
            })
            ->orderBy('data_sorteio')
            ->get();

        return view('home', compact('rifas', 'banners'));
    }
}