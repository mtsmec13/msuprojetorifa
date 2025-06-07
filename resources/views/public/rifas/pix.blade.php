@extends('layouts.app')
@section('content')
<div class="container text-center">
    <h2>Pagamento via Pix</h2>
    <p><strong>Rifa:</strong> {{ $rifa->nome }}</p>
    <p><strong>Número:</strong> {{ $compra->numero }}</p>
    @if(isset($imagem))
        <img src="data:image/png;base64,{{ $imagem }}" alt="QR Code Pix" style="max-width:300px">
    @endif
    <div class="my-3">
        <label><strong>Copie e cole este código no app do banco:</strong></label>
        <input type="text" class="form-control" value="{{ $qrcode }}" readonly onclick="this.select()">
    </div>
    <p class="text-muted">A confirmação pode levar até 1 minuto após o pagamento.</p>
</div>
@endsection