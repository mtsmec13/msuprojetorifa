<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $rifa->titulo }} - Detalhes da Rifa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .rifa-img {
            max-width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
        }
        .numero {
            width: 45px;
            display: inline-block;
            margin: 2px;
            text-align: center;
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 4px 0;
            font-weight: bold;
            cursor: pointer;
        }
        .numero.comprado {
            background: #dc3545;
            color: #fff;
            pointer-events: none;
            opacity: 0.6;
        }
        .numero.disponivel {
            background: #28a745;
            color: #fff;
        }
        .numero.selecionado {
            background: #ffc107 !important;
            color: #000 !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">Site de Rifas</a>
        <div class="d-flex">
            <a href="/login" class="btn btn-sm btn-light me-2">Entrar</a>
            <a href="/register" class="btn btn-sm btn-outline-light">Cadastre-se</a>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <a href="/" class="btn btn-secondary mb-3">&larr; Voltar</a>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $rifa->imagem ?? 'https://via.placeholder.com/600x350?text=Sem+Imagem' }}" alt="Imagem da Rifa" class="rifa-img mb-3">
        </div>
        <div class="col-md-6">
            <h2>{{ $rifa->titulo }}</h2>
            <p>{{ $rifa->descricao }}</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Valor:</strong> R$ {{ number_format($rifa->valor, 2, ',', '.') }}</li>
                <li class="list-group-item"><strong>Sorteio:</strong> {{ \Carbon\Carbon::parse($rifa->data_sorteio)->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Vendidos:</strong> {{ $rifa->numeros_vendidos }} / {{ $rifa->quantidade_numeros }}</li>
            </ul>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $erro)
                        <div>{{ $erro }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('rifa.comprar', $rifa->id) }}" method="POST" id="form-compra">
                @csrf
                <div class="mb-2">
                    <label><strong>Escolha um ou mais números disponíveis:</strong></label>
                    <div>
                        @for($i=1; $i<=$rifa->quantidade_numeros; $i++)
                            @php
                                $classe = in_array($i, $comprados) ? 'comprado' : 'disponivel';
                                $checked = is_array(old('numeros')) && in_array($i, old('numeros', []));
                            @endphp
                            <span
                                class="numero {{ $classe }}{{ $checked ? ' selecionado' : '' }}"
                                data-numero="{{ $i }}">
                                {{ $i }}
                            </span>
                        @endfor
                    </div>
                </div>
                <input type="hidden" name="numeros[]" id="numeros-escolhidos" value="{{ json_encode(old('numeros', [])) }}">
                <div class="mb-2">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
                <div class="mb-3">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}" required placeholder="(99) 99999-9999">
                </div>
                <button type="submit" class="btn btn-success btn-lg">Comprar Números</button>
            </form>
        </div>
    </div>
</div>
<script>
    let numerosSelecionados = {!! json_encode(old('numeros', [])) !!};

    document.querySelectorAll('.numero.disponivel').forEach(function(elem) {
        elem.addEventListener('click', function() {
            let numero = parseInt(this.dataset.numero);
            if (numerosSelecionados.includes(numero)) {
                numerosSelecionados = numerosSelecionados.filter(n => n !== numero);
                this.classList.remove('selecionado');
            } else {
                numerosSelecionados.push(numero);
                this.classList.add('selecionado');
            }
            document.getElementById('numeros-escolhidos').value = JSON.stringify(numerosSelecionados);
        });
    });

    document.getElementById('form-compra').addEventListener('submit', function(e) {
        if(numerosSelecionados.length === 0) {
            alert('Escolha pelo menos um número disponível!');
            e.preventDefault();
        } else {
            document.querySelectorAll('input[name="numeros[]"]').forEach(function(input){ input.remove(); });
            numerosSelecionados.forEach(function(numero) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'numeros[]';
                input.value = numero;
                document.getElementById('form-compra').appendChild(input);
            });
        }
    });

    // Destacar números selecionados ao voltar por erro
    numerosSelecionados.forEach(function(numero){
        let elem = document.querySelector('.numero.disponivel[data-numero="'+numero+'"]');
        if(elem){
            elem.classList.add('selecionado');
        }
    });
</script>
</body>
</html>