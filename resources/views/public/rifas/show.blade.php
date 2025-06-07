@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Cabeçalho da Rifa --}}
    <div class="mb-3">
        <h1 class="mb-1">{{ $rifa->nome }}</h1>
        <p class="text-muted">{{ $rifa->descricao }}</p>
        <div>
            <strong>Status:</strong>
            @if($rifa->status == 'finalizada')
                <span class="badge bg-danger">Finalizada</span>
            @elseif($rifa->status == 'ativa')
                <span class="badge bg-success">Ativa</span>
            @else
                <span class="badge bg-secondary">{{ ucfirst($rifa->status) }}</span>
            @endif
        </div>
        {{-- Contador regressivo, se houver --}}
        @if($rifa->data_sorteio)
            <div class="mt-2">
                <strong>Sorteio em:</strong>
                <span id="countdown"></span>
            </div>
        @endif
    </div>

    {{-- Grade de Números --}}
    <div class="mb-4">
        <h4>Escolha seu número</h4>
        <form method="POST" action="{{ route('rifa.reservar', $rifa->id) }}">
            @csrf
            <div class="grid grid-cols-2 gap-1 sm:grid-cols-4 md:grid-cols-8 xl:grid-cols-12">
                @for ($i = 1; $i <= $rifa->quantidade_numeros; $i++)
                    @php
                        $ocupado = in_array($i, $numerosOcupados);
                        $compra = $vendas[$i] ?? null;
                        $meu = $compra && auth()->check() && $compra->user_id === auth()->id();
                    @endphp
                    <label class="d-block mb-1">
                        <input type="radio" name="numero" value="{{ $i }}" {{ $ocupado ? 'disabled' : '' }} style="display:none;">
                        <span class="badge 
                            {{ $meu ? 'bg-warning text-dark' : ($ocupado ? 'bg-danger' : 'bg-success') }}"
                            style="padding: 12px; font-size: 16px; cursor: {{ $ocupado ? 'not-allowed' : 'pointer' }};">
                            {{ str_pad($i, 3, '0', STR_PAD_LEFT) }}
                            @if($meu)
                                <small>(Meu)</small>
                            @elseif($ocupado)
                                <small>(Ocupado)</small>
                            @endif
                        </span>
                    </label>
                @endfor
            </div>
            <button type="submit" class="btn btn-primary mt-3">Reservar Número</button>
        </form>
        <small class="text-muted d-block mt-2">Números em verde estão disponíveis. Em vermelho, já foram reservados.</small>
    </div>

    {{-- Ranking dos Top Compradores --}}
    @if(isset($ranking) && count($ranking))
    <div class="mb-4">
        <h4>Ranking dos maiores compradores</h4>
        <ol>
            @foreach($ranking as $user)
                <li>
                    <strong>{{ $user->name ?? 'Usuário #' . $user->id }}</strong>
                    - {{ $user->total_comprado ?? 0 }} números comprados
                </li>
            @endforeach
        </ol>
    </div>
    @endif

    {{-- Prêmios --}}
    @if(isset($premios) && is_array($premios) && count($premios))
    <div class="mb-4">
        <h4>Prêmios</h4>
        <ul>
            @foreach($premios as $indice => $premio)
                <li><strong>Prêmio {{ $indice + 1 }}:</strong> {{ $premio['descricao'] ?? $premio }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Painel do Usuário --}}
    @auth
    <div class="mb-4">
        <h4>Meus Números Reservados</h4>
        @php
            $meusNumeros = collect($vendas)
                ->filter(fn($compra) => $compra->user_id === auth()->id())
                ->keys()
                ->toArray();
        @endphp
        @if(count($meusNumeros))
            <span>
                @foreach($meusNumeros as $num)
                    <span class="badge bg-warning text-dark mx-1">{{ str_pad($num, 3, '0', STR_PAD_LEFT) }}</span>
                @endforeach
            </span>
        @else
            <span class="text-muted">Você não reservou nenhum número ainda.</span>
        @endif
    </div>
    @endauth
</div>

{{-- Script para contador regressivo (exemplo, adapte para seu padrão) --}}
@if($rifa->data_sorteio)
<script>
    function countdown() {
        var fim = new Date("{{ $rifa->data_sorteio }}").getTime();
        var x = setInterval(function() {
            var agora = new Date().getTime();
            var distancia = fim - agora;
            if (distancia <= 0) {
                document.getElementById("countdown").innerHTML = "Sorteio realizado!";
                clearInterval(x);
            } else {
                var d = Math.floor(distancia / (1000 * 60 * 60 * 24));
                var h = Math.floor((distancia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var m = Math.floor((distancia % (1000 * 60 * 60)) / (1000 * 60));
                var s = Math.floor((distancia % (1000 * 60)) / 1000);
                document.getElementById("countdown").innerHTML = d + "d " + h + "h " + m + "m " + s + "s ";
            }
        }, 1000);
    }
    countdown();
</script>
@endif
@endsection