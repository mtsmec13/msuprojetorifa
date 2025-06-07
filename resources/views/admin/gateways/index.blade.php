@extends('admin.layout')

@section('title', 'Gateways de Pagamento')

@section('content')
<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4">Gateways Ativos</h2>
    <table class="min-w-full text-sm text-left">
        <thead class="border-b">
            <tr>
                <th class="py-2">Nome</th>
                <th class="py-2">Chave Pix</th>
                <th class="py-2">Status</th>
                <th class="py-2 text-right">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gateways as $gateway)
            <tr class="border-b">
                <td class="py-2">{{ $gateway->nome }}</td>
                <td class="py-2">{{ $gateway->chave_pix }}</td>
                <td class="py-2">
                    <span class="px-2 py-1 rounded text-white {{ $gateway->status ? 'bg-green-500' : 'bg-red-500' }}">
                        {{ $gateway->status ? 'Ativo' : 'Inativo' }}
                    </span>
                </td>
                <td class="py-2 text-right">
                    <a href="{{ route('admin.gateways.edit', $gateway) }}" class="text-blue-500 hover:underline">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection