@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2">Total de Rifas</h2>
        <p class="text-3xl">{{ $rifasCount ?? 0 }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2">Compras</h2>
        <p class="text-3xl">{{ $comprasCount ?? 0 }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-2">Usuários</h2>
        <p class="text-3xl">{{ $usersCount ?? 0 }}</p>
    </div>
</div>
@endsection