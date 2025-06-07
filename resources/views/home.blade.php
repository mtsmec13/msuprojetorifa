{{-- Este ficheiro usa o método tradicional @extends --}}
@extends('layouts.app')

{{-- O conteúdo é colocado dentro da secção 'content' --}}
@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Bem-vindo ao <span class="text-blue-500">{{ config('app.name') }}</span></h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-400">A sua sorte começa aqui. Explore as nossas rifas e participe para ganhar prémios incríveis.</p>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-white">Rifas em Destaque</h2>
                <a href="{{ route('public.rifas.index') }}" class="text-blue-400 hover:text-blue-300 font-semibold">
                    Ver todas &rarr;
                </a>
            </div>

            {{-- Assumindo que o seu HomeController envia uma variável $rifasEmDestaque --}}
            @if(isset($rifasEmDestaque) && $rifasEmDestaque->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($rifasEmDestaque as $rifa)
                        <div class="card-rifa" style="background-color: #161b22; border: 1px solid #30363d; border-radius: 16px; overflow: hidden; transition: all 0.3s ease;">
                            <a href="{{ route('public.rifas.show', $rifa) }}">
                                <div class="relative">
                                    <img class="aspect-video w-full object-cover" src="{{ $rifa->imagem_url ?? 'https://placehold.co/600x400/0d1117/58a6ff?text=Prémio' }}" alt="{{ $rifa->titulo }}">
                                    <div class="status-badge ativa" style="position: absolute; top: 12px; left: 12px; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(34, 197, 94, 0.9); color: white;">Ativa</div>
                                </div>
                            </a>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2 truncate">{{ $rifa->titulo }}</h3>
                                <p class="text-gray-400 text-sm mb-4 h-10 overflow-hidden">{{ $rifa->descricao_curta }}</p>
                                <a href="{{ route('public.rifas.show', $rifa) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                                    Participar por R$ {{ number_format($rifa->valor_numero, 2, ',', '.') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 bg-gray-800 rounded-lg">
                    <i data-feather="gift" class="h-12 w-12 mx-auto text-gray-500"></i>
                    <h3 class="mt-4 text-xl font-semibold text-white">Nenhuma Rifa em Destaque</h3>
                    <p class="mt-1 text-gray-400">Fique atento, em breve teremos novas oportunidades!</p>
                </div>
            @endif
        </div>
    </div>

@endsection


