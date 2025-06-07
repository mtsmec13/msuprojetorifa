<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function show(User $user)
    {
        $compras = $user->compras()->with('rifa')->get();
        return view('admin.usuarios.show', compact('user', 'compras'));
    }

    public function inativar(User $user)
    {
        $user->update(['is_active' => false]);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário inativado!');
    }
}