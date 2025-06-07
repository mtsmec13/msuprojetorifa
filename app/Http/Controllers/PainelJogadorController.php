<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Compra;

class PainelJogadorController extends Controller
{
    public function index()
    {
        $compras = Compra::where('user_id', Auth::id())->with('rifa')->get();
        return view('painel.index', compact('compras'));
    }
}