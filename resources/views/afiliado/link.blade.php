
@extends('layouts.app')

@section('title', 'Meu Link de Afiliado')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-semibold mb-4">Divulgue e ganhe comissões</h2>
    <p class="mb-4">Compartilhe seu link de afiliado e ganhe uma comissão por cada compra feita por ele.</p>

    <div class="flex items-center bg-gray-100 rounded px-3 py-2">
        <input type="text" readonly class="w-full bg-transparent focus:outline-none" value="{{ $link }}" id="afiliado-link">
        <button onclick="copiar()" class="ml-2 px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Copiar</button>
    </div>
</div>

<script>
    function copiar() {
        const input = document.getElementById('afiliado-link');
        input.select();
        document.execCommand('copy');
        alert('Link copiado para a área de transferência!');
    }
</script>
@endsection
