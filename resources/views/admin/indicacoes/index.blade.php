
@extends('admin.layout')

@section('title', 'Indicações')

@section('content')
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Bônus por Indicação</h2>
    <table class="min-w-full text-sm text-left">
        <thead class="border-b">
            <tr>
                <th class="py-2">Quem Indicou</th>
                <th class="py-2">Indicado</th>
                <th class="py-2">Bônus Recebido</th>
                <th class="py-2">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indicacoes as $ind)
            <tr class="border-b">
                <td class="py-2">{{ $ind->usuario->name ?? 'N/A' }}</td>
                <td class="py-2">{{ $ind->indicado->name ?? 'N/A' }}</td>
                <td class="py-2">{{ $ind->bonus }} R$</td>
                <td class="py-2">{{ $ind->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
