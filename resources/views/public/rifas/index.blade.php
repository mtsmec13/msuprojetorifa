@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Rifas ativas e finalizadas</h1>
    <div class="row">
        @foreach($rifas as $rifa)
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    @if($rifa->imagem)
                        <img src="{{ $rifa->imagem }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $rifa->titulo }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($rifa->descricao, 80) }}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('public.rifas.show', $rifa) }}" class="btn btn-primary">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection