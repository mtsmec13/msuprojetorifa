@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Minhas Rifas e Números</h2>
    @forelse($compras as $compra)
        <div class="card mb-3">
            <div class="card-body">
                <b>Rifa:</b> {{ $compra->rifa->titulo }}<br>
                <b>Número:</b> {{ $compra->numero }}<br>
                <b>Data da compra:</b> {{ $compra->created_at->format('d/m/Y H:i') }}<br>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Você ainda não participou de nenhuma rifa.</div>
    @endforelse
</div>
@endsection