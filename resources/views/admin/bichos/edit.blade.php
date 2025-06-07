@extends('layouts.admin')

@section('content')
<h1>Editar Bicho</h1>
<form action="{{ route('admin.bichos.update', $bicho) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" value="{{ $bicho->nome }}" required>

    <label for="imagem">Imagem:</label>
    @if($bicho->imagem)
    <img src="{{ asset('storage/' . $bicho->imagem) }}" alt="{{ $bicho->nome }}" width="100"><br>
    @endif
    <input type="file" name="imagem" id="imagem">

    <button type="submit">Atualizar</button>
</form>
@endsection
