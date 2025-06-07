<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Rifas | @yield('title', \App\Models\Configuracao::get('site_nome', 'Rifa Premium'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ \App\Models\Configuracao::get('site_favicon') }}">
    <meta name="description" content="{{ \App\Models\Configuracao::get('site_descricao', 'Participe das melhores rifas online!') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Quicksand:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cor-fundo: #13181e;
            --cor-card: #181e25;
            --cor-verde: #17cf5b;
            --cor-dourado: #ffcc3e;
            --cor-cinza: #242b33;
            --cor-texto: #f5f5f5;
            --cor-borda: #232b32;
        }
        body {
            background: var(--cor-fundo);
            color: var(--cor-texto);
            font-family: 'Quicksand', 'Montserrat', Arial, Helvetica, sans-serif;
        }
        .navbar {
            background: var(--cor-card)!important;
            border-bottom: 2px solid var(--cor-dourado);
            font-family: 'Montserrat', sans-serif;
        }
        .navbar .navbar-brand {
            color: var(--cor-dourado)!important;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .navbar .nav-link {
            color: #fffde8 !important;
            font-size: 1.08rem;
        }
        .navbar .nav-link.active, .navbar .nav-link:hover {
            color: var(--cor-dourado) !important;
        }
        .btn-main {
            background: linear-gradient(90deg, var(--cor-dourado), #ffd500 80%);
            color: #232b32;
            font-weight: bold;
            border: none;
            border-radius: 22px;
            font-size: 1.13rem;
            padding: 10px 30px;
            box-shadow: 0 2px 16px #ffcc3e70;
            transition: background .16s, color .16s, transform .16s;
        }
        .btn-main:hover {
            background: linear-gradient(90deg, #ffd500, var(--cor-dourado) 60%);
            color: #181e25;
            transform: scale(1.05);
        }
        .card-premium {
            background: var(--cor-card);
            border-radius: 18px;
            box-shadow: 0 6px 28px #0f0f0f50;
            border: 1.5px solid var(--cor-borda);
            color: var(--cor-texto);
            margin-bottom: 32px;
        }
        .card-premium .card-title {
            color: var(--cor-dourado);
            font-weight: bold;
            font-size: 1.2em;
        }
        .footer {
            background: var(--cor-card);
            color: #fffde8;
            padding: 28px 0 16px;
            margin-top: 40px;
            font-size: 1.09rem;
            border-top: 2px solid var(--cor-dourado);
        }
        .section-title {
            color: var(--cor-dourado);
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            letter-spacing: 1.2px;
        }
        .esperanca-banner {
            background: linear-gradient(120deg, #232b33 0%, #1e352c 100%);
            color: #fff;
            border-radius: 20px;
            margin-bottom: 36px;
            box-shadow: 0 4px 24px #0002;
            padding: 28px 18px;
            min-height: 180px;
        }
        @media (max-width: 767px) {
            .esperanca-banner {
                padding: 16px 10px;
                min-height: 120px;
                text-align: center;
            }
            .navbar .navbar-brand { font-size: 1.3rem; }
            .btn-main { font-size: 1.01rem; padding: 8px 18px; }
        }
        .accordion-button { font-size: 1.01rem; }
    </style>
    @stack('head')
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            @if(\App\Models\Configuracao::get('site_logo'))
                <img src="{{ \App\Models\Configuracao::get('site_logo') }}" alt="Logo" style="height:32px;">
            @else Rifa Premium @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item"><a href="{{ route('public.rifas.index') }}" class="nav-link">Sorteios</a></li>
                <li class="nav-item"><a href="{{ route('bicho.resultado') }}" class="nav-link">Jogo do Bicho</a></li>
                @auth
                    <li class="nav-item"><a href="{{ route('painel') }}" class="nav-link">Meu Painel</a></li>
                    @if(auth()->user()->is_admin ?? false)
                        <li class="nav-item"><a href="{{ route('admin.rifas.index') }}" class="nav-link text-warning">Admin</a></li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav mb-2 mb-md-0">
                @guest
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Entrar</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Cadastrar</a></li>
                @else
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm ms-2">Sair</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-3">
    @if(session('success'))
        <div class="alert alert-success shadow">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger shadow">{{ session('error') }}</div>
    @endif
</div>
@yield('content')
<footer class="footer text-center">
    <div class="container">
        <small>
            &copy; {{ date('Y') }} {{ \App\Models\Configuracao::get('site_nome', 'Rifa Premium') }}.
            @if(\App\Models\Configuracao::get('site_redes_sociais'))
                <br>
                {!! \App\Models\Configuracao::get('site_redes_sociais') !!}
            @endif
        </small>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>