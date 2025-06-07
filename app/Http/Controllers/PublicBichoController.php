<?php

namespace App\Http\Controllers;
use App\Models\ResultadoBicho;

class PublicBichoController extends Controller
{
    public function index()
    {
        $resultado = ResultadoBicho::orderBy('data', 'desc')->first();
        return view('public.bicho.resultado', compact('resultado'));
    }
}