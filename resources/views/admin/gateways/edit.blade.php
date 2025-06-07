
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Editar Gateway: {{ $gateway->nome }}</h2>
    <form action="{{ route('admin.gateways.update', $gateway->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $gateway->nome }}" readonly>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="status" value="1" {{ $gateway->status ? 'checked' : '' }}>
            <label class="form-check-label">Ativar Gateway</label>
        </div>
        <div class="mb-3">
            <label class="form-label">Client ID</label>
            <input type="text" name="client_id" class="form-control" value="{{ $gateway->client_id }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Client Secret</label>
            <input type="text" name="client_secret" class="form-control" value="{{ $gateway->client_secret }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Chave Pix</label>
            <input type="text" name="chave_pix" class="form-control" value="{{ $gateway->chave_pix }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Webhook URL</label>
            <input type="text" name="webhook_url" class="form-control" value="{{ $gateway->webhook_url }}">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
