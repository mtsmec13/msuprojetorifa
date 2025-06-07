@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Compras - {{ $rifa->titulo }}</h2>
    {{-- Bloco de sorteio/vencedores já mostrado em respostas anteriores --}}
    {{-- ...código para definir vencedores, exportar para excel, etc... --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número</th>
                <th>Nome</th>
                <th>WhatsApp</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
        @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->numero }}</td>
                <td>{{ $compra->nome }}</td>
                <td>{{ $compra->whatsapp }}</td>
                <td>{{ $compra->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.rifas.index') }}" class="btn btn-secondary mt-2">Voltar</a>
</div>
@endsection