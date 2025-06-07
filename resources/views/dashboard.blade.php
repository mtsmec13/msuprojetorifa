@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gray-900 text-gray-100 py-8 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- Card principal do sorteio destaque --}}
        <div class="md:col-span-2">
            @if($sorteioDestaque)
            <div class="bg-gradient-to-r from-blue-700 to-indigo-900 p-6 rounded-xl flex items-center gap-6 shadow-lg">
                <img src="{{ $sorteioDestaque->imagem ?? '/img/moto.png' }}" alt="Prêmio" class="w-32 h-32 object-contain">
                <div>
                    <h2 class="text-2xl font-bold mb-2">
                        Ganhe uma <span class="text-yellow-400">{{ $sorteioDestaque->nome }}</span>
                    </h2>
                    <p class="mb-4">{{ $sorteioDestaque->descricao }}</p>
                    <a href="{{ route('public.rifas.show', $sorteioDestaque->id) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black px-5 py-2 rounded-lg font-semibold transition">Participar</a>
                </div>
            </div>
            @endif

            {{-- Sorteios Disponíveis --}}
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Sorteios Disponíveis</h3>
                @forelse($sorteiosDisponiveis as $sorteio)
                <div class="bg-gray-800 rounded-lg p-4 flex items-center justify-between mb-3">
                    <div>
                        <h4 class="font-bold">{{ $sorteio->nome }}</h4>
                        <span class="text-gray-400 text-sm">{{ $sorteio->descricao }}</span>
                    </div>
                    <a href="{{ route('public.rifas.show', $sorteio->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Participar</a>
                </div>
                @empty
                <div class="text-gray-400">Nenhum sorteio disponível no momento.</div>
                @endforelse
            </div>
        </div>

        {{-- Sidebar cards --}}
        <div class="space-y-6">
            <div class="bg-gray-800 rounded-lg flex items-center gap-4 p-4">
                <div class="bg-blue-700 p-3 rounded-full">
                    <i class="ph ph-ticket text-2xl"></i>
                </div>
                <div>
                    <div class="font-bold text-xl">{{ $totalBilhetes }}</div>
                    <div class="text-gray-400 text-sm">Bilhetes</div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg flex items-center gap-4 p-4">
                <div class="bg-purple-700 p-3 rounded-full">
                    <i class="ph ph-trophy text-2xl"></i>
                </div>
                <div>
                    <div class="font-bold text-xl">{{ $totalSorteios }}</div>
                    <div class="text-gray-400 text-sm">Sorteios Ativos</div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-lg flex items-center gap-4 p-4">
                <div class="bg-green-700 p-3 rounded-full">
                    <i class="ph ph-wallet text-2xl"></i>
                </div>
                <div>
                    <div class="font-bold text-xl">R$ {{ number_format($saldoConta, 2, ',', '.') }}</div>
                    <div class="text-gray-400 text-sm">Conta</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ADMIN DASHBOARD --}}
    <div class="max-w-7xl mx-auto mt-12">
        <div class="bg-gray-800 rounded-xl p-6 shadow-lg">
            <h3 class="text-xl font-bold mb-4">Painel do Administrador</h3>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 mb-4">
                <div class="bg-gray-700 rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold">{{ $totalUsuarios }}</div>
                    <div class="text-gray-400">Usuários</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold">{{ $totalBilhetes }}</div>
                    <div class="text-gray-400">Bilhetes</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold">R$ {{ number_format($totalFaturamento, 2, ',', '.') }}</div>
                    <div class="text-gray-400">Faturamento</div>
                </div>
                <div class="bg-gray-700 rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold">{{ $totalSorteios }}</div>
                    <div class="text-gray-400">Sorteios Ativos</div>
                </div>
            </div>
            <div>
                <h4 class="mb-2 font-semibold">Últimos Sorteios</h4>
                <div class="flex gap-4">
                    @foreach($ultimosSorteios as $sorteio)
                    <div class="bg-blue-900 rounded-lg p-4 flex-1">
                        <div class="font-bold">{{ $sorteio->nome }}</div>
                        <div class="text-sm text-gray-400">{{ $sorteio->compras()->count() }} bilhetes vendidos</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection