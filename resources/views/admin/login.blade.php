@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width:400px;">
    <h2 class="mb-4 text-center">Login Administrativo</h2>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Lembrar-me</label>
        </div>
        <button class="btn btn-primary w-100">Entrar</button>
    </form>
</div>
@endsection