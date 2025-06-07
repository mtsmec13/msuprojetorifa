@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Configurações do Sistema</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.configuracoes.salvar') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="habilitar_jogo_bicho">Habilitar Jogo do Bicho</label>
            <select class="form-control" name="habilitar_jogo_bicho" id="habilitar_jogo_bicho">
                <option value="1" {{ App\Models\Configuracao::get('habilitar_jogo_bicho') ? 'selected' : '' }}>Sim</option>
                <option value="0" {{ !App\Models\Configuracao::get('habilitar_jogo_bicho') ? 'selected' : '' }}>Não</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nome_sistema">Nome do Sistema</label>
            <input type="text" name="nome_sistema" id="nome_sistema" class="form-control"
                   value="{{ App\Models\Configuracao::get('nome_sistema', 'Minha Rifa') }}">
        </div>

        <div class="form-group mb-3">
            <label for="whatsapp_suporte">WhatsApp de Suporte</label>
            <input type="text" name="whatsapp_suporte" id="whatsapp_suporte" class="form-control"
                   value="{{ App\Models\Configuracao::get('whatsapp_suporte') }}">
        </div>

        <div class="form-group mb-3">
            <label for="texto_rodape">Texto do Rodapé</label>
            <input type="text" name="texto_rodape" id="texto_rodape" class="form-control"
                   value="{{ App\Models\Configuracao::get('texto_rodape') }}">
        </div>

        <button type="submit" class="btn btn-success">Salvar Configurações</button>
    </form>
</div>
@endsection
