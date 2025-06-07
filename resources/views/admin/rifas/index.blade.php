@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rifas</h2>
    <a href="{{ route('admin.rifas.create') }}" class="btn btn-primary mb-3">Nova Rifa</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Qtd. Números</th>
                <th>Sorteio</th>
                <th>Banner?</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rifas as $rifa)
            <tr>
                <td>{{ $rifa->titulo }}</td>
                <td>{{ Str::limit($rifa->descricao, 30) }}</td>
                <td>R$ {{ number_format($rifa->valor, 2, ',', '.') }}</td>
                <td>{{ $rifa->quantidade_numeros }}</td>
                <td>{{ \Carbon\Carbon::parse($rifa->data_sorteio)->format('d/m/Y H:i') }}</td>
                <td>@if($rifa->mostrar_banner)<span class="badge bg-success">Sim</span>@else Não @endif</td>
                <td>
                    <a href="{{ route('admin.rifas.edit', $rifa) }}" class="btn btn-sm btn-warning">Editar</a>
                    <a href="{{ route('admin.rifas.compras', $rifa) }}" class="btn btn-sm btn-info">Compras</a>
                    <form action="{{ route('admin.rifas.destroy', $rifa) }}" method="POST" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection