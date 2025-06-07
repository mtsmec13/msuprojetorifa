<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao; // Importa o Model que representa a tabela

class PublicRifaController extends Controller
{
    /**
     * Exibe a página principal da rifa, buscando as configurações no banco.
     */
    public function index()
    {
        // Pega a PRIMEIRA configuração salva no banco de dados.
        $configRifa = Configuracao::first();

        // Se não encontrar nenhuma configuração, exibe uma mensagem de erro.
        if (!$configRifa) {
            return "Erro: Nenhuma configuração de rifa foi encontrada. Rode as migrations e os seeders.";
        }
        
        // Se encontrou, envia os dados para a view (página visual)
        // Você precisará criar a view 'public.rifas.index' depois
        // return view('public.rifas.index', compact('configRifa'));
        
        // Por enquanto, vamos apenas mostrar os dados na tela para confirmar que funciona:
        return response()->json($configRifa);
    }
}
