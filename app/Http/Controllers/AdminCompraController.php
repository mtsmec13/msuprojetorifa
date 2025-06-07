<?php

namespace App\Http\Controllers;

use App\Models\Compra;

class AdminCompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('rifa', 'user')->orderBy('created_at', 'desc')->get();
        return view('admin.compras.index', compact('compras'));
    }

    public function show(Compra $compra)
    {
        $compra->load('rifa', 'user');
        return view('admin.compras.show', compact('compra'));
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('admin.compras.index')->with('success', 'Compra removida!');
    }
}