
@extends('admin.layout')

@section('title', 'Cupons de Desconto')

@section('content')
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Cupons</h2>
    <a href="{{ route('admin.cupons.create') }}" class="inline-block mb-4 p-2 bg-blue-500 text-white rounded hover:bg-blue-600">Criar Novo Cupom</a>
    <table class="min-w-full text-sm text-left">
        <thead class="border-b">
            <tr>
                <th class="py-2">Código</th>
                <th class="py-2">Desconto</th>
                <th class="py-2">Validade</th>
                <th class="py-2">Status</th>
                <th class="py-2 text-right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cupons as $cupom)
            <tr class="border-b">
                <td class="py-2">{{ $cupom->codigo }}</td>
                <td class="py-2">{{ $cupom->desconto }}%</td>
                <td class="py-2">{{ $cupom->validade->format('d/m/Y') }}</td>
                <td class="py-2">
                    <span class="px-2 py-1 rounded text-white {{ $cupom->status ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $cupom->status ? 'Ativo' : 'Inativo' }}
                    </span>
                </td>
                <td class="py-2 text-right">
                    <a href="{{ route('admin.cupons.edit', $cupom) }}" class="text-blue-500 hover:underline">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
