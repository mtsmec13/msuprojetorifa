@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2>Resultados do Jogo do Bicho</h2>
    <a href="{{ route('admin.bicho.create') }}" class="btn btn-success mb-3">Novo Resultado</a>
    <table class="table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Número</th>
                <th>Dezena</th>
                <th>Bicho</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $r)
            <tr>
                <td>{{ \Carbon\Carbon::parse($r->data)->format('d/m/Y') }}</td>
                <td>{{ $r->numero_sorteado }}</td>
                <td>{{ $r->dezena }}</td>
                <td>{{ $r->bicho[0] }}</td>
                <td><img src="/bichos/{{ $r->bicho[1] }}" style="height:40px"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection