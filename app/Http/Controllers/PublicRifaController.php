<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracao; // Importa o Model para buscar os dados da rifa

class PublicRifaController extends Controller
{
    /**
     * Este é o método que estava faltando.
     * Ele será executado quando alguém acessar a URL /rifas.
     * Sua responsabilidade é buscar os dados e mostrar a página.
     */
    public function index()
    {
        // 1. Busca no banco de dados a primeira configuração da rifa que encontrar.
        $configRifa = Configuracao::first();

        // 2. Verifica se alguma configuração foi encontrada.
        if (!$configRifa) {
            // Se não encontrou, mostra uma mensagem de erro útil.
            // Isso geralmente acontece se o banco de dados está vazio.
            return "<h1>Erro</h1><p>Nenhuma configuração de rifa foi encontrada no banco de dados. Você já executou o comando `php artisan migrate:fresh --seed`?</p>";
        }

        // 3. Se encontrou os dados, retorna a 'view' (o arquivo HTML)
        // e envia os dados da rifa para a página.
        // O nome da view será 'rifas.index'
        return view('rifas.index', ['configRifa' => $configRifa]);
    }

    // Se você tiver outros métodos (show, create, etc.), eles virão aqui.
}
