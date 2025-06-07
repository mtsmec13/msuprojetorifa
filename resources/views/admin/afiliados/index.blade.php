
@extends('admin.layout')

@section('title', 'Painel de Afiliados')

@section('content')
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Comissões de Afiliados</h2>
    <table class="min-w-full text-sm text-left">
        <thead class="border-b font-semibold">
            <tr>
                <th class="py-2">Afiliado</th>
                <th class="py-2">Compra Referenciada</th>
                <th class="py-2">Comissão (R$)</th>
                <th class="py-2">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($afiliados as $af)
            <tr class="border-b">
                <td class="py-2">{{ $af->afiliado->name ?? 'N/A' }}</td>
                <td class="py-2">#{{ $af->referencia_compra_id }}</td>
                <td class="py-2 text-green-600 font-bold">{{ number_format($af->comissao, 2, ',', '.') }}</td>
                <td class="py-2">{{ $af->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
