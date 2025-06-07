@extends('layouts.admin')

@section('content')
<h1>Novo Bicho</h1>
<form action="{{ route('admin.bichos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>

    <label for="imagem">Imagem:</label>
    <input type="file" name="imagem" id="imagem">

    <button type="submit">Salvar</button>
</form>
@endsection
