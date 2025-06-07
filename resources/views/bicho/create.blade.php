@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Cadastrar Resultado do Jogo do Bicho</h2>
    <form method="POST" action="{{ route('admin.bicho.store') }}">
        @csrf
        <div class="mb-3">
            <label>Data do sorteio</label>
            <input type="date" name="data" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Número sorteado (1 a 100)</label>
            <input type="number" name="numero_sorteado" class="form-control" min="1" max="100" required>
        </div>
        <button class="btn btn-primary">Salvar Resultado</button>
    </form>
</div>
@endsection