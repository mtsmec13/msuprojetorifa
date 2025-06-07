
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ranking de Participantes</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>WhatsApp</th>
                <th>Total de Compras</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ranking as $index => $participante)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $participante->nome }}</td>
                <td>{{ $participante->whatsapp }}</td>
                <td>{{ $participante->total_compras }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
