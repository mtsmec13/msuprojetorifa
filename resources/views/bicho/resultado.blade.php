@extends('layouts.app')
@section('title', 'Resultado do Jogo do Bicho')
@section('content')
<style>
.bg-bicho-gradient {
    background: linear-gradient(120deg, #fd297b 0%, #6f19ce 100%);
    color: #fff;
    border-radius: 28px;
    box-shadow: 0 10px 40px #fd297b40;
    padding: 40px 30px;
    margin: 40px auto 0;
    max-width: 500px;
    position: relative;
    overflow: hidden;
}
.resultado-numero {
    font-size: 4.2rem;
    font-weight: 900;
    letter-spacing: 2px;
    color: #fff;
    text-shadow: 0 2px 18px #fd297b80, 0 0 2px #fff;
    animation: popnum 1.2s cubic-bezier(.23,1.54,.7,1.13);
}
@keyframes popnum {
    0% { transform: scale(0.2); opacity: 0; }
    80% { transform: scale(1.08); }
    100% { transform: scale(1); opacity: 1; }
}
.resultado-bicho-img {
    max-height: 120px;
    filter: drop-shadow(0 4px 20px #6f19ce90);
    border-radius: 18px;
    background: #fff2;
    margin: 18px auto;
    display: block;
    transition: transform 0.16s;
}
.resultado-bicho-img:hover {
    transform: scale(1.08) rotate(-2deg);
}
.btn-voz {
    background: linear-gradient(90deg, #fd297b 0%, #6f19ce 100%);
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 15px 38px;
    font-size: 1.3rem;
    border-radius: 30px;
    box-shadow: 0 3px 28px #fd297b80;
    margin-top: 22px;
    transition: background 0.18s, transform 0.14s;
}
.btn-voz:hover {
    background: linear-gradient(90deg, #6f19ce 0%, #fd297b 100%);
    transform: scale(1.06);
}
</style>
<div class="container">
    <div class="bg-bicho-gradient text-center">
        <h1 class="mb-4" style="font-family:Montserrat,Lexend,sans-serif; font-weight:bold; font-size:2.1rem;">🎲 Resultado do Jogo do Bicho</h1>
        @if($resultado)
            <div class="resultado-numero mb-1">{{ $resultado->numero_sorteado }}</div>
            <div class="mb-2" style="font-size:1.2em;">
                <span class="badge bg-success" style="font-size:1.1em;">Dezena: {{ $resultado->dezena }}</span>
            </div>
            <div class="mb-2" style="font-size:1.2em;">
                <span class="badge bg-primary" style="font-size:1.1em;">Bicho: {{ $resultado->bicho[0] }}</span>
            </div>
            <div>
                <img src="/bichos/{{ $resultado->bicho[1] }}" alt="Bicho" class="resultado-bicho-img shadow">
            </div>
            <button class="btn btn-voz mt-4" onclick="falarResultado()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 16 16" style="margin-right:8px;">
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
                }, 1000);
            }
            </script>
            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-light px-4 py-2" style="border-radius:18px;">Voltar para Home</a>
            </div>
        @else
            <div class="alert alert-info">Nenhum resultado cadastrado ainda.</div>
        @endif
    </div>
</div>
@endsection