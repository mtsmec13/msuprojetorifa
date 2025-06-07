@extends('layouts.admin')
@section('content')
<h2 class="text-2xl font-bold mb-6">Configuração de Gateway de Pagamento</h2>
@if(session('sucesso'))
    <div class="bg-green-700 text-white px-4 py-2 rounded mb-4">{{ session('sucesso') }}</div>
@endif
<form method="POST" action="{{ route('admin.gateway.salvar') }}" class="space-y-4 max-w-xl">
    @csrf
    <div>
        <label class="block mb-1">Tipo de Gateway</label>
        <select name="tipo" class="w-full rounded px-3 py-2 bg-gray-700 text-white">
            <option value="efi" {{ ($gateway->tipo ?? '')=='efi' ? 'selected' : '' }}>Efi (Gerencianet)</option>
            <option value="pagseguro" {{ ($gateway->tipo ?? '')=='pagseguro' ? 'selected' : '' }}>PagSeguro</option>
            <option value="pagbank" {{ ($gateway->tipo ?? '')=='pagbank' ? 'selected' : '' }}>PagBank</option>
        </select>
    </div>
    <div>
        <label class="block mb-1">Chave Pix/Token</label>
        <input type="text" name="chave" value="{{ $gateway->chave ?? '' }}" class="w-full rounded px-3 py-2 bg-gray-700 text-white">
    </div>
    <div>
        <label class="block mb-1">Token Secreto</label>
        <input type="text" name="token" value="{{ $gateway->token ?? '' }}" class="w-full rounded px-3 py-2 bg-gray-700 text-white">
    </div>
    <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-5 py-2 rounded">Salvar</button>
</form>
@endsection