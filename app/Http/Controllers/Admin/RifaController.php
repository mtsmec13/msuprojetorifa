<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rifa;
use App\Models\Numero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RifaController extends Controller
{
    /**
     * Exibe a lista de todas as rifas com paginação.
     */
    public function index()
    {
        $rifas = Rifa::withCount('numerosVendidos')->latest()->paginate(10);
        return view('admin.rifas.index', compact('rifas'));
    }

    /**
     * Mostra o formulário para criar uma nova rifa.
     */
    public function create()
    {
        return view('admin.rifas.create');
    }

    /**
     * Guarda uma nova rifa na base de dados e cria os seus números.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade_numeros' => 'required|integer|min:1',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Pausada,Finalizada',
        ]);
        
        // Usa uma transação para garantir que a rifa e os seus números são criados com sucesso
        DB::transaction(function () use ($validated) {
            $rifa = Rifa::create($validated);
            
            // Cria os números para a rifa
            $numeros = [];
            for ($i = 0; $i < $rifa->quantidade_numeros; $i++) {
                $numeros[] = ['rifa_id' => $rifa->id, 'numero' => $i, 'status' => 'Disponivel', 'created_at' => now(), 'updated_at' => now()];
            }
            // Insere todos os números de uma só vez para melhor performance
            Numero::insert($numeros);
        });

        return redirect()->route('admin.rifas.index')->with('success', 'Rifa criada com sucesso!');
    }

    /**
     * Mostra o formulário para editar uma rifa existente.
     */
    public function edit(Rifa $rifa)
    {
        return view('admin.rifas.edit', compact('rifa'));
    }

    /**
     * Atualiza uma rifa existente na base de dados.
     */
    public function update(Request $request, Rifa $rifa)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Pausada,Finalizada',
        ]);
        
        $rifa->update($validated);

        return redirect()->route('admin.rifas.index')->with('success', 'Rifa atualizada com sucesso!');
    }

    /**
     * Apaga uma rifa e todos os seus números associados.
     */
    public function destroy(Rifa $rifa)
    {
        $rifa->delete();
        return redirect()->route('admin.rifas.index')->with('success', 'Rifa apagada com sucesso!');
    }
}

