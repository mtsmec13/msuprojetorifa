@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Rifa</h2>
    <form action="{{ route('admin.rifas.update', $rifa) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.rifas.form')
        <button class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection