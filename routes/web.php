<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicRifaController;
// Futuramente, você pode criar um controller só para o admin:
// use App\Http\Controllers\Admin\RifaController as AdminRifaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Este arquivo define todas as rotas da sua aplicação.
|
*/

// --- ROTAS PÚBLICAS ---
// Tudo que qualquer visitante pode ver.

// 1. Página inicial do Laravel (Opcional, pode remover ou alterar)
Route::get('/', function () {
    return view('welcome');
});

// 2. Página que lista todas as rifas disponíveis para o público
Route::get('/rifas', [PublicRifaController::class, 'index'])->name('rifas.index');

// 3. Página que mostra os detalhes de UMA rifa específica
// O {rifa} é um parâmetro dinâmico, por exemplo: /rifas/1 ou /rifas/5
Route::get('/rifas/{rifa}', [PublicRifaController::class, 'show'])->name('rifas.show');


// --- ROTAS ADMINISTRATIVAS ---
// Ações que SÓ o administrador do site pode realizar.
// O ideal é proteger essas rotas com um prefixo e autenticação.

Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    // Usando Route::resource, o Laravel cria automaticamente TODAS as rotas 
    // necessárias para gerenciar (Criar, Ler, Atualizar, Deletar) as rifas.
    // Isso evita que você tenha que escrever 7 rotas manualmente.
    
    // Exemplo: Route::resource('rifas', AdminRifaController::class);
    
    // Por enquanto, vamos manter com o seu controller atual para não quebrar nada:
    
    // Rota para mostrar o formulário de criação de nova rifa
    Route::get('/rifas/create', [PublicRifaController::class, 'create'])->name('admin.rifas.create');
    
    // Rota para salvar a nova rifa no banco de dados
    Route::post('/rifas', [PublicRifaController::class, 'store'])->name('admin.rifas.store');
    
    // Rota para mostrar o formulário de edição de uma rifa existente
    Route::get('/rifas/{rifa}/edit', [PublicRifaController::class, 'edit'])->name('admin.rifas.edit');
    
    // Rota para atualizar a rifa no banco de dados
    Route::put('/rifas/{rifa}', [PublicRifaController::class, 'update'])->name('admin.rifas.update');
    
    // Rota para deletar uma rifa
    Route::delete('/rifas/{rifa}', [PublicRifaController::class, 'destroy'])->name('admin.rifas.destroy');
    
});

// Rotas de autenticação (login, registro, etc.) que o Laravel pode gerar
// Se ainda não tiver, execute `composer require laravel/ui` e `php artisan ui bootstrap --auth`
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

