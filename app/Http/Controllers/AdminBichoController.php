<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResultadoBicho;

class AdminBichoController extends Controller
{
    public function index()
    {
        $resultados = ResultadoBicho::orderBy('data', 'desc')->get();
        return view('admin.bicho.index', compact('resultados'));
    }

    public function create()
    {
        return view('admin.bicho.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'numero_sorteado' => 'required|integer|min:1|max:100'
        ]);
        ResultadoBicho::create($request->only('data', 'numero_sorteado'));
        return redirect()->route('admin.bicho.index')->with('success', 'Resultado cadastrado!');
    }
}