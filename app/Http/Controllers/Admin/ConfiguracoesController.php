<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuracao;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        return view('admin.configuracoes');
    }

    public function salvar(Request $request)
    {
        Configuracao::set('habilitar_jogo_bicho', $request->input('habilitar_jogo_bicho', false));
        Configuracao::set('nome_sistema', $request->input('nome_sistema'));
        Configuracao::set('whatsapp_suporte', $request->input('whatsapp_suporte'));
        Configuracao::set('texto_rodape', $request->input('texto_rodape'));

        return redirect()->route('admin.configuracoes.index')->with('success', 'Configurações salvas com sucesso!');
    }
}
