{{-- resources/views/public/rifas/index.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifas Online - Prémios Incríveis</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Ícones (Feather Icons) -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .card-rifa {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .card-rifa:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }
        .card-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .tab-btn {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .tab-btn.active {
            color: #58a6ff;
            border-bottom-color: #58a6ff;
        }
        .status-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-badge.ativa {
            background-color: rgba(34, 197, 94, 0.9);
            color: white;
        }
        .status-badge.finalizada {
            background-color: rgba(248, 81, 73, 0.9);
            color: white;
        }
    </style>
</head>
<body>

    <!-- CABEÇALHO (Adapte conforme o seu layout principal) -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center space-x-2">
                    <i data-feather="star" class="text-blue-500 h-7 w-7"></i>
                    <span class="text-white font-bold text-xl">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex items-center space-x-3">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Entrar</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-bold">Registar</a>
                    @else
                        <a href="{{ route('painel') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Meu Painel</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-bold">Sair</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">Concorra a Prémios <span class="text-blue-500">Incríveis</span></h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-400">Escolha a sua rifa favorita, selecione os seus números da sorte e participe. Boa sorte!</p>
        </div>

        <!-- ABAS DE NAVEGAÇÃO -->
        <div class="border-b border-gray-700 mb-8">
            <nav class="-mb-px flex space-x-6 justify-center" aria-label="Tabs">
                <button class="tab-btn active whitespace-nowrap py-4 px-1 border-b-2 font-bold text-lg" data-tab="ativas">
                    Rifas Ativas
                </button>
                <button class="tab-btn text-gray-400 hover:text-white whitespace-nowrap py-4 px-1 border-b-2 border-transparent font-medium text-lg" data-tab="finalizadas">
                    Finalizadas
                </button>
            </nav>
        </div>

        <!-- GRADE DE RIFAS ATIVAS -->
        <div id="tab-content-ativas">
            @if($rifasAtivas->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {{-- O loop agora usa a variável correta: $rifasAtivas --}}
                    @foreach($rifasAtivas as $rifa)
                        <div class="card-rifa">
                            <a href="{{ route('public.rifas.show', $rifa) }}">
                                <div class="relative">
                                    <img class="aspect-video w-full object-cover" src="{{ $rifa->imagem_url ?? 'https://placehold.co/600x400/0d1117/58a6ff?text=Prémio' }}" alt="{{ $rifa->titulo }}">
                                    <div class="status-badge ativa">Ativa</div>
                                </div>
                            </a>
                            <div class="p-6 card-content">
                                <div>
                                    <h3 class="text-xl font-bold text-white mb-2 truncate">{{ $rifa->titulo }}</h3>
                                    <p class="text-gray-400 text-sm mb-4 h-10 overflow-hidden">{{ $rifa->descricao_curta }}</p>
                                </div>
                                <div>
                                    @php
                                        $vendidos = $rifa->numeros_vendidos_count;
                                        $total = $rifa->quantidade_numeros;
                                        $percentagem = $total > 0 ? ($vendidos / $total) * 100 : 0;
                                    @endphp
                                    <div class="w-full bg-gray-700 rounded-full h-2.5 mb-2">
                                        <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $percentagem }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-400 mb-5">
                                        <span>{{ round($percentagem) }}% vendido</span>
                                        <span>{{ $vendidos }}/{{ $total }}</span>
                                    </div>
                                    <a href="{{ route('public.rifas.show', $rifa) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                                        Participar por R$ {{ number_format($rifa->valor_numero, 2, ',', '.') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 bg-gray-800 rounded-lg">
                    <i data-feather="gift" class="h-12 w-12 mx-auto text-gray-500"></i>
                    <h3 class="mt-4 text-xl font-semibold text-white">Nenhuma Rifa Ativa</h3>
                    <p class="mt-1 text-gray-400">Volte em breve para novas oportunidades!</p>
                </div>
            @endif
        </div>

        <!-- GRADE DE RIFAS FINALIZADAS (Usa a variável $rifasFinalizadas) -->
        <div id="tab-content-finalizadas" class="hidden">
             @if($rifasFinalizadas->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($rifasFinalizadas as $rifa)
                        <div class="card-rifa opacity-70">
                             <a href="{{ route('public.rifas.show', $rifa) }}">
                                <div class="relative">
                                    <img class="aspect-video w-full object-cover" src="{{ $rifa->imagem_url ?? 'https://placehold.co/600x400/0d1117/f85149?text=Prémio' }}" alt="{{ $rifa->titulo }}">
                                    <div class="status-badge finalizada">Finalizada</div>
                                </div>
                            </a>
                            <div class="p-6 card-content">
                                <div>
                                    <h3 class="text-xl font-bold text-white mb-2 truncate">{{ $rifa->titulo }}</h3>
                                    <p class="text-gray-400 text-sm mb-4">Sorteio realizado!</p>
                                </div>
                                <div>
                                    <a href="{{ route('public.rifas.show', $rifa) }}" class="block w-full text-center bg-gray-700 text-gray-400 font-bold py-3 px-4 rounded-lg cursor-not-allowed">
                                        Ver Resultado
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 bg-gray-800 rounded-lg">
                    <i data-feather="check-circle" class="h-12 w-12 mx-auto text-gray-500"></i>
                    <h3 class="mt-4 text-xl font-semibold text-white">Nenhuma Rifa Finalizada</h3>
                    <p class="mt-1 text-gray-400">Os resultados das rifas anteriores aparecerão aqui.</p>
                </div>
            @endif
        </div>
    </main>

    <script>
        // Adiciona os ícones do Feather Icons
        feather.replace();

        // Lógica para as abas
        const tabs = document.querySelectorAll('.tab-btn');
        const tabContents = {
            ativas: document.getElementById('tab-content-ativas'),
            finalizadas: document.getElementById('tab-content-finalizadas')
        };
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetTab = tab.dataset.tab;
                Object.values(tabContents).forEach(content => content.classList.add('hidden'));
                tabs.forEach(t => {
                    t.classList.remove('active', 'font-bold', 'text-blue-500', 'border-blue-500');
                    t.classList.add('text-gray-400', 'border-transparent', 'font-medium');
                });
                tabContents[targetTab].classList.remove('hidden');
                tab.classList.add('active', 'font-bold', 'text-blue-500', 'border-blue-500');
                tab.classList.remove('text-gray-400', 'border-transparent', 'font-medium');
            });
        });
    </script>
</body>
</html>

