@extends('layouts.admin')

@section('content')
<h1>Bichos</h1>
<a href="{{ route('admin.bichos.create') }}">Novo Bicho</a>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bichos as $bicho)
        <tr>
            <td>{{ $bicho->nome }}</td>
            <td>
                @if($bicho->imagem)
                <img src="{{ asset('storage/' . $bicho->imagem) }}" alt="{{ $bicho->nome }}" width="100">
                @endif
            </td>
            <td>
                <a href="{{ route('admin.bichos.edit', $bicho) }}">Editar</a>
                <form action="{{ route('admin.bichos.destroy', $bicho) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
