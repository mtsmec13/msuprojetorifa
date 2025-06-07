
<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function index()
    {
        $cupons = Cupom::all();
        return view('admin.cupons.index', compact('cupons'));
    }

    public function create()
    {
        return view('admin.cupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons,codigo',
            'desconto' => 'required|numeric|min:1',
            'validade' => 'required|date',
        ]);

        Cupom::create($request->all());

        return redirect()->route('admin.cupons.index')->with('success', 'Cupom criado com sucesso!');
    }

    public function edit(Cupom $cupom)
    {
        return view('admin.cupons.edit', compact('cupom'));
    }

    public function update(Request $request, Cupom $cupom)
    {
        $request->validate([
            'codigo' => 'required|unique:cupons,codigo,' . $cupom->id,
            'desconto' => 'required|numeric|min:1',
            'validade' => 'required|date',
        ]);

        $cupom->update($request->all());

        return redirect()->route('admin.cupons.index')->with('success', 'Cupom atualizado com sucesso!');
    }
}
