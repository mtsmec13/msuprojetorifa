@extends('layouts.app')

@section('content')
<div class="container py-4">
    <a href="{{ route('public.rifas.index') }}" class="btn btn-secondary mb-3">&larr; Voltar</a>
    <div class="row">
        <div class="col-md-6">
            @if($rifa->imagem)
                <img src="{{ $rifa->imagem }}" style="max-width:100%;border-radius:8px;">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $rifa->titulo }}</h2>
            <p>{{ $rifa->descricao }}</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><b>Valor:</b> R$ {{ number_format($rifa->valor, 2, ',', '.') }}</li>
                <li class="list-group-item"><b>Data do sorteio:</b> {{ \Carbon\Carbon::parse($rifa->data_sorteio)->format('d/m/Y') }}</li>
                <li class="list-group-item"><b>Status:</b> 
                    @if($rifa->numero_sorteado_1 || $rifa->numero_sorteado_2 || $rifa->numero_sorteado_3)
                        Finalizada
                    @else
                        Ativa
                    @endif
                </li>
            </ul>