@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nova Rifa</h2>
    <form action="{{ route('admin.rifas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.rifas.form')
        <button class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection