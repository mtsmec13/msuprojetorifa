
@extends('admin.layout')

@section('title', 'Configurações do Sistema')

@section('content')
<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Configurações Gerais</h2>
    <form action="{{ route('admin.configuracoes.salvar') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium">Ativar bônus por indicação</label>
            <input type="checkbox" name="bonus_indicacao" value="1" {{ config('bonus_indicacao') ? 'checked' : '' }} class="w-5 h-5">
        </div>
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium">Ativar sistema de afiliados</label>
            <input type="checkbox" name="afiliados" value="1" {{ config('afiliados') ? 'checked' : '' }} class="w-5 h-5">
        </div>
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Salvar</button>
    </form>
</div>
@endsection
