@extends('layouts.app')
@section('title', 'Sorteios de Sucesso!')

@section('content')
<div class="container">

    {{-- Banner responsivo --}}
    <div class="row align-items-center my-5">
        <div class="col-md-7 col-12">
            <div class="esperanca-banner mb-4 mb-md-0">
                <h1 class="mb-2" style="font-size:2rem; font-weight:700;">Mude sua sorte, conquiste prêmios!</h1>
                <p class="mb-3" style="font-size:1.04rem; font-weight:400;">
                    Escolha seu sorteio favorito, pague online, acompanhe o sorteio e veja os ganhadores ao vivo! Sorteios rápidos, transparentes e com prêmios imperdíveis.
                </p>
                <a href="{{ route('public.rifas.index') }}" class="btn btn-main px-4 py-2 mt-1" style="font-size:1.04rem;">Ver Sorteios</a>
            </div>
        </div>
        <div class="col-md-5 col-12 text-center mt-3 mt-md-0">
            @if(isset($banners) && $banners->count() && $banners->first()->imagem)
                <img src="{{ $banners->first()->imagem }}" class="img-fluid rounded shadow-lg" style="max-height:180px;object-fit:cover;">
            @else
                <img src="https://cdn.pixabay.com/photo/2017/07/04/19/49/lottery-2478477_1280.png" alt="Banner" class="img-fluid" style="max-height:180px;">
            @endif
        </div>
    </div>

    <h2 class="section-title text-center my-4" style="font-size:1.35rem;">Nossos Sorteios</h2>
    <div class="row">
        @forelse($rifas as $rifa)
            <div class="col-md-4 col-12 mb-4">
                <div class="card card-premium h-100">
                    @if($rifa->imagem)
                        <img src="{{ $rifa->imagem }}" class="card-img-top" style="height:110px; object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:1.03rem;">{{ $rifa->titulo }}</h5>
                        <p class="card-text" style="font-size:0.95rem;">{{ \Illuminate\Support\Str::limit($rifa->descricao, 65) }}</p>
                        <ul class="list-group list-group-flush mb-2">
                            <li class="list-group-item" style="font-size:0.92rem;"><b>Valor:</b> <span class="text-success">R$ {{ number_format($rifa->valor,2,',','.') }}</span></li>
                            <li class="list-group-item" style="font-size:0.92rem;"><b>Sorteio:</b> <span class="text-warning">{{ \Carbon\Carbon::parse($rifa->data_sorteio)->format('d/m/Y H:i') }}</span></li>
                        </ul>
                    </div>
                    <div class="card-footer text-center bg-transparent">
                        <a href="{{ route('public.rifas.show', $rifa) }}" class="btn btn-outline-light btn-sm me-2">Detalhes</a>
                        <a href="{{ route('rifa.show', $rifa->id) }}" class="btn btn-main btn-sm">Participar</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Nenhum sorteio cadastrado ainda.</div>
            </div>
        @endforelse
    </div>

    <h2 class="section-title text-center my-5" style="font-size:1.22rem;">Perguntas Frequentes (FAQ)</h2>
    <div class="accordion mb-5" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent1" aria-expanded="true">
                    Como participo de um sorteio?
                </button>
            </h2>
            <div id="faqContent1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body" style="font-size:0.98rem;">
                    Basta escolher um sorteio, selecionar seus números e efetuar o pagamento pelo site. Você receberá a confirmação por WhatsApp!
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent2">
                    Quais formas de pagamento são aceitas?
                </button>
            </h2>
            <div id="faqContent2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body" style="font-size:0.98rem;">
                    Aceitamos Pix, boleto e cartão de crédito, tudo online, rápido e seguro.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent3">
                    Como sei se ganhei?
                </button>
            </h2>
            <div id="faqContent3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body" style="font-size:0.98rem;">
                    O resultado é divulgado ao vivo no site e você também é notificado pelo WhatsApp cadastrado.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqContent4">
                    É seguro participar?
                </button>
            </h2>
            <div id="faqContent4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body" style="font-size:0.98rem;">
                    Sim! Nosso sistema é transparente, protegido e todos os sorteios têm auditoria e divulgação pública.
                </div>
            </div>
        </div>
    </div>

    <div class="text-center my-5">
@php
    $habilitar_bicho = \App\Models\Configuracao::get('habilitar_jogo_bicho', false);
@endphp
@if($habilitar_bicho)
    <a href="{{ route('bicho.resultado') }}" class="btn btn-primary">Ver Resultado do Jogo do Bicho</a>
@endif
    </div>
</div>
@endsection