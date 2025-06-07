<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Só permite login de admin
        if(Auth::attempt(array_merge($credentials, ['is_admin' => true]), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.rifas.index'));
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos, ou você não é admin.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}