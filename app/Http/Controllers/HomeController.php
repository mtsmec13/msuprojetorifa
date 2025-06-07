<?php

namespace App\Http\Controllers;

use App\Models\Rifa;

class HomeController extends Controller
{
    public function index()
{
    $premiosDestaque = \App\Models\Rifa::where('status', 'ativa')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get();

    return view('home', [
        'premiosDestaque' => $premiosDestaque
    ]);
}
    public function home()
{
    // Busca as rifas ativas como prêmios em destaque
    $premiosDestaque = \App\Models\Rifa::where('status', 'ativa')
        ->orderByDesc('created_at')
        ->limit(6)
        ->get();

    return view('home', [
        'premiosDestaque' => $premiosDestaque
    ]);
}
}