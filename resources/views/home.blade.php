@extends('layouts.app')
@section('content')

<div class="bg-gradient-to-br from-gray-900 via-gray-800 to-indigo-900 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-6">
        {{-- HERO SECTION --}}
        <div class="flex flex-col md:flex-row items-center gap-10 py-10">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-5 text-yellow-400 drop-shadow">
                    Concorra a prêmios incríveis em rifas online seguras!
                </h1>
                <p class="mb-6 text-gray-200 text-lg">
                    Participe de sorteios oficiais, pague com Pix ou cartão, acompanhe tudo em tempo real e mude de vida agora mesmo!
                </p>
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-8 py-3 rounded-lg text-lg transition">Ver meus bilhetes</a>
                @else
                    <a href="{{ route('public.rifas.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-8 py-3 rounded-lg text-lg transition">Ver Rifas</a>
                @endauth
            </div>
            <div class="flex-1 flex justify-center">
                <img src="/img/banner-premios.png" alt="Prêmios" class="w-96 rounded-xl shadow-lg ring-4 ring-yellow-500/20">
            </div>
        </div>

        {{-- CARDS DE PRÊMIOS EM DESTAQUE --}}
        <h2 class="text-2xl font-bold mb-6 text-white mt-12">Prêmios em Destaque</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mb-12">
            @foreach($premiosDestaque as $premio)
                <div class="bg-gray-800 rounded-xl p-6 shadow-lg hover:scale-105 transition">
                    <img src="{{ $premio->imagem ?? '/img/premio.png' }}" alt="Prêmio" class="w-full h-40 object-contain mb-4 rounded border border-gray-700">
                    <div class="font-bold text-xl text-yellow-400 mb-2">{{ $premio->nome }}</div>
                    <div class="mb-4 text-gray-200">{{ $premio->descricao }}</div>
                    {{-- LINK CORRETO: usa $premio->id pois é uma Rifa --}}
                    <a href="{{ route('public.rifas.show', $premio->id) }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg font-semibold transition">Participar</a>
                </div>
            @endforeach
        </div>

        {{-- ...outros blocos opcionais, como depoimentos ou segurança... --}}
    </div>
</div>
@endsection