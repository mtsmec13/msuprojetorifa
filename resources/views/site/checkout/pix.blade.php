
@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4">Pagamento via Pix</h2>
    <p>Escaneie o QR Code com seu banco ou copie o código abaixo:</p>
    <div class="mb-4">
        {!! QrCode::size(240)->generate($pixPayload) !!}
    </div>
    <textarea class="form-control text-center" rows="3" readonly>{{ $pixPayload }}</textarea>
    <p class="mt-4 text-muted">Após o pagamento, aguarde a confirmação automática. Você receberá uma notificação!</p>
</div>
@endsection
