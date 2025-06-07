@extends('layouts.app')
@section('title', 'Resultado do Jogo do Bicho')
@section('content')
<style>
.bg-bicho-esperanca {
    background: linear-gradient(135deg, #4bbf6b 0%, #209cff 100%);
    color: #fff;
    border-radius: 30px;
    box-shadow: 0 10px 40px #4bbf6b50;
    padding: 40px 30px;
    margin: 40px auto 0;
    max-width: 480px;
    position: relative;
    border: 3px solid #ffd700;
    overflow: hidden;
}
.resultado-numero {
    font-size: 4rem;
    font-weight: 900;
    color: #ffd700;
    text-shadow: 0 2px 20px #18332f70;
    margin-bottom: 8px;
    letter-spacing: 2px;
    animation: popnum 1.2s cubic-bezier(.18,1.54,.7,1.13);
}
@keyframes popnum {
    0% { transform: scale(0.1); opacity: 0; }
    80% { transform: scale(1.07); }
    100% { transform: scale(1); opacity: 1; }
}
.badge.bg-success, .badge.bg-primary {
    background: #ffd700!important;
    color: #18332f!important;
    font-size: 1.2em;
    font-weight: bold;
    padding: 10px 22px;
    border-radius: 18px;
    box-shadow: 0 2px 16px #ffd70060;
}
.resultado-bicho-img {
    max-height: 120px;
    filter: drop-shadow(0 4px 18px #209cffb3);
    border-radius: 18px;
    background: #fff2;
    margin: 18px auto 8px;
    display: block;
    transition: transform 0.16s;
}
.resultado-bicho-img:hover {
    transform: scale(1.08) rotate(-2deg);
}
.btn-voz {
    background: linear-gradient(90deg, #ffd700 0%, #4bbf6b 100%);
    border: none;
    color: #18332f;
    font-weight: bold;
    padding: 15px 38px;
    font-size: 1.3rem;
    border-radius: 30px;
    box-shadow: 0 3px 28px #ffd70080;
    margin-top: 22px;
    transition: background 0.18s, transform 0.14s;
}
.btn-voz:hover {
    background: linear-gradient(90deg, #4bbf6b 0%, #ffd700 100%);
    color: #fff;
    transform: scale(1.08);
}
</style>
<div class="container">
    <div class="bg-bicho-esperanca text-center">
        <h1 class="mb-4" style="font-family:Montserrat,Quicksand,sans-serif; font-weight:bold; font-size:2rem;">🍀 Resultado do Jogo do Bicho</h1>
        @if($resultado)
            <div class="resultado-numero mb-1">{{ $resultado->numero_sorteado }}</div>
            <div class="mb-2">
                <span class="badge bg-success">Dezena: {{ $resultado->dezena }}</span>
            </div>
            <div class="mb-2">
                <span class="badge bg-primary">Bicho: {{ $resultado->bicho[0] }}</span>
            </div>
            <div>
                <img src="/bichos/{{ $resultado->bicho[1] }}" alt="Bicho" class="resultado-bicho-img shadow">
            </div>
            <button class="btn btn-voz mt-4" onclick="falarResultado()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#18332f" viewBox="0 0 16 16" style="margin-right:8px;">
                  <path d="M11.536 14.01a.75.75 0 0 1-.016-1.06 6.5 6.5 0 0 0 0-9.9.75.75 0 1 1 .88-1.2 8 8 0 0 1 0 12.3.75.75 0 0 1-1.064-.016z"/><path d="M9.73 11.832a.75.75 0 0 1-.021-1.06 3.5 3.5 0 0 0 0-5.544.75.75 0 0 1 .94-1.175 5 5 0 0 1 0 7.894.75.75 0 0 1-1.06-.021z"/><path d="M8 9.5a1.5 1.5 0 0 0 0-3v3z"/><path d="M8 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8a.5.5 0 0 1 .5-.5z"/>
                </svg>
                Ouvir Resultado
            </button>
            <script>
            function falarResultado() {
                var texto = "O resultado do jogo do bicho: número {{ $resultado->numero_sorteado }}, dezena {{ $resultado->dezena }}, bicho {{ $resultado->bicho[0] }}";
                var synth = window.speechSynthesis;
                var utter = new SpeechSynthesisUtterance(texto);
                utter.lang = 'pt-BR';
                synth.speak(utter);
            }
            window.onload = function(){
                setTimeout(function(){
                    falarResultado();
                }, 1200);
            }
            </script>
            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-main px-4 py-2" style="border-radius:18px;">Voltar para Home</a>
            </div>
        @else
            <div class="alert alert-warning bg-white text-dark">Nenhum resultado cadastrado ainda.</div>
        @endif
    </div>
</div>
@endsection