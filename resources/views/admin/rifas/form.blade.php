<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rifa;
use App\Models\Compra;
use Illuminate\Support\Facades\Storage;

class AdminRifaController extends Controller
{
    public function index()
    {
        $rifas = Rifa::orderBy('created_at', 'desc')->get();
        return view('admin.rifas.index', compact('rifas'));
    }

    public function create()
    {
        return view('admin.rifas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'quantidade_numeros' => 'required|integer|min:1',
            'data_sorteio' => 'required|date',
            'tipo_sorteio' => 'required|in:manual,automatico',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $imagem = null;
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('imagens', 'public');
        }

        Rifa::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'imagem' => $imagem ? '/storage/' . $imagem : null,
            'quantidade_numeros' => $request->quantidade_numeros,
            'data_sorteio' => $request->data_sorteio,
            'tipo_sorteio' => $request->tipo_sorteio,
            'premio_1' => $request->premio_1,
            'premio_2' => $request->premio_2,
            'premio_3' => $request->premio_3,
            'mostrar_banner' => $request->has('mostrar_banner'),
        ]);

        return redirect()->route('admin.rifas.index')->with('success', 'Rifa criada com sucesso!');
    }

    public function edit(Rifa $rifa)
    {
        return view('admin.rifas.edit', compact('rifa'));
    }

    public function update(Request $request, Rifa $rifa)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'quantidade_numeros' => 'required|integer|min:1',
            'data_sorteio' => 'required|date',
            'tipo_sorteio' => 'required|in:manual,automatico',
            'imagem' => 'nullable|image|max:2048',
        ]);

        $imagem = $rifa->imagem;
        if ($request->hasFile('imagem')) {
            if ($imagem) {
                $path = str_replace('/storage/', '', $imagem);
                Storage::disk('public')->delete($path);
            }
            $imagem = '/storage/' . $request->file('imagem')->store('imagens', 'public');
        }

        $rifa->update([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'imagem' => $imagem,
            'quantidade_numeros' => $request->quantidade_numeros,
            'data_sorteio' => $request->data_sorteio,
            'tipo_sorteio' => $request->tipo_sorteio,
            'premio_1' => $request->premio_1,
            'premio_2' => $request->premio_2,
            'premio_3' => $request->premio_3,
            'mostrar_banner' => $request->has('mostrar_banner'),
        ]);

        return redirect()->route('admin.rifas.index')->with('success', 'Rifa atualizada com sucesso!');
    }

    public function destroy(Rifa $rifa)
    {
        if ($rifa->imagem) {
            $path = str_replace('/storage/', '', $rifa->imagem);
            Storage::disk('public')->delete($path);
        }
        $rifa->delete();

        return redirect()->route('admin.rifas.index')->with('success', 'Rifa excluída com sucesso!');
    }

    public function compras(Rifa $rifa)
    {
        $compras = Compra::where('rifa_id', $rifa->id)->orderBy('numero')->get();
        return view('admin.rifas.compras', compact('rifa', 'compras'));
    }

    // SORTEIO MANUAL
    public function definirVencedores(Request $request, Rifa $rifa)
    {
        $rules = [];
        for ($i=1; $i<=3; $i++) {
            if ($rifa->{'premio_'.$i}) {
                $rules['numero_sorteado_'.$i] = [
                    'nullable',
                    'integer',
                    function($attribute, $value, $fail) use ($rifa) {
                        if ($value && !Compra::where('rifa_id', $rifa->id)->where('numero', $value)->exists()) {
                            $fail('O número '.$value.' não foi comprado nesta rifa.');
                        }
                    },
                ];
            }
        }

        $request->validate($rules);

        for ($i=1; $i<=3; $i++) {
            if ($rifa->{'premio_'.$i}) {
                $rifa->{'numero_sorteado_'.$i} = $request->{'numero_sorteado_'.$i} ?: null;
            }
        }
        $rifa->save();

        return redirect()->back()->with('success', 'Vencedores definidos com sucesso!');
    }

    // SORTEIO AUTOMÁTICO
    public function sortear(Rifa $rifa)
    {
        $compras = $rifa->compras()->pluck('numero')->toArray();

        if (count($compras) === 0) {
            return redirect()->back()->with('error', 'Nenhum participante nesta rifa!');
        }

        $vencedores = [];
        $max_vencedores = 0;
        foreach([1,2,3] as $i) {
            if ($rifa->{'premio_'.$i}) $max_vencedores++;
        }
        if ($max_vencedores == 0) {
            return redirect()->back()->with('error', 'Configure ao menos um prêmio!');
        }

        $numeros_disponiveis = $compras;
        for ($i=1; $i <= $max_vencedores; $i++) {
            if (count($numeros_disponiveis) == 0) break;
            $sorteado = $numeros_disponiveis[array_rand($numeros_disponiveis)];
            $vencedores[] = $sorteado;
            $numeros_disponiveis = array_diff($numeros_disponiveis, [$sorteado]);
        }

        $rifa->numero_sorteado_1 = $vencedores[0] ?? null;
        $rifa->numero_sorteado_2 = $vencedores[1] ?? null;
        $rifa->numero_sorteado_3 = $vencedores[2] ?? null;
        $rifa->save();

        return redirect()->back()->with('success', 'Sorteio realizado com sucesso!');
    }
}