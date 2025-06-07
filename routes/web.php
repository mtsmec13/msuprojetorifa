<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRifaController;
use App\Http\Controllers\PublicBichoController;
use App\Http\Controllers\PainelJogadorController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRifaController;
use App\Http\Controllers\Admin\AdminCompraController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminConfigController;
use App\Http\Controllers\Admin\AdminBichoController;
use App\Http\Controllers\Admin\AfiliadosController;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
| Rotas acessíveis a todos os visitantes.
*/

// Página Inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Listagem pública de rifas
Route::get('/rifas', [PublicRifaController::class, 'index'])->name('public.rifas.index');

// Detalhes da rifa, compra e reserva de números
Route::get('/rifas/{rifa}', [PublicRifaController::class, 'show'])->name('public.rifas.show');
Route::post('/rifas/{rifa}/reservar', [PublicRifaController::class, 'reservar'])->name('rifa.reservar');

// Página do resultado do Jogo do Bicho
Route::get('/bicho', [PublicBichoController::class, 'index'])->name('bicho.resultado');

/*
|--------------------------------------------------------------------------
| WEBHOOKS DE PAGAMENTO
|--------------------------------------------------------------------------
| Rotas para receber notificações de status de pagamento dos gateways.
*/

Route::post('/webhook/pagbank', [WebhookController::class, 'pagbank'])->name('webhook.pagbank');
Route::post('/webhook/efi', [WebhookController::class, 'efi'])->name('webhook.efi');
Route::post('/webhook/paggue', [WebhookController::class, 'paggue'])->name('webhook.paggue');
Route::post('/webhook/suitpay', [WebhookController::class, 'suitpay'])->name('webhook.suitpay');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
| Inclui rotas de login, registro, etc., do Laravel Breeze.
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ÁREA DO USUÁRIO AUTENTICADO
|--------------------------------------------------------------------------
| Rotas que exigem que o usuário esteja logado.
*/

Route::middleware(['auth'])->group(function () {
    // Painel do Jogador
    Route::get('/painel', [PainelJogadorController::class, 'index'])->name('painel');

    // Link de Afiliado
    Route::get('/meu-link', [AfiliadoController::class, 'meuLink'])->name('afiliado.link');
});


/*
|--------------------------------------------------------------------------
| PAINEL ADMINISTRATIVO
|--------------------------------------------------------------------------
| Todas as rotas administrativas agrupadas e protegidas.
| Acessível apenas por usuários autenticados que são administradores.
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Rifas (CRUD)
    Route::get('rifas', [AdminRifaController::class, 'index'])->name('rifas.index');
    Route::get('rifas/create', [AdminRifaController::class, 'create'])->name('rifas.create');
    Route::post('rifas', [AdminRifaController::class, 'store'])->name('rifas.store');
    Route::get('rifas/{rifa}/edit', [AdminRifaController::class, 'edit'])->name('rifas.edit');
    Route::put('rifas/{rifa}', [AdminRifaController::class, 'update'])->name('rifas.update');
    Route::delete('rifas/{rifa}', [AdminRifaController::class, 'destroy'])->name('rifas.destroy');
    Route::get('rifas/{rifa}/compras', [AdminRifaController::class, 'compras'])->name('rifas.compras');
    Route::post('rifas/{rifa}/vencedores', [AdminRifaController::class, 'definirVencedores'])->name('rifas.vencedores');
    Route::post('rifas/{rifa}/sortear', [AdminRifaController::class, 'sortear'])->name('rifas.sortear');

    // Compras
    Route::get('compras', [AdminCompraController::class, 'index'])->name('compras.index');
    Route::get('compras/{compra}', [AdminCompraController::class, 'show'])->name('compras.show');
    Route::delete('compras/{compra}', [AdminCompraController::class, 'destroy'])->name('compras.destroy');

    // Usuários
    Route::get('usuarios', [AdminUserController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/{user}', [AdminUserController::class, 'show'])->name('usuarios.show');
    Route::put('usuarios/{user}/inativar', [AdminUserController::class, 'inativar'])->name('usuarios.inativar');

    // Jogo do Bicho
    Route::get('bicho', [AdminBichoController::class, 'index'])->name('bicho.index');
    Route::get('bicho/create', [AdminBichoController::class, 'create'])->name('bicho.create');
    Route::post('bicho', [AdminBichoController::class, 'store'])->name('bicho.store');

    // Afiliados
    Route::get('afiliados', [AfiliadosController::class, 'index'])->name('afiliados');

    // Configurações Gerais e de Gateway
    Route::get('configuracoes', [AdminConfigController::class, 'index'])->name('config.index');
    Route::post('configuracoes', [AdminConfigController::class, 'store'])->name('config.store');
    Route::get('gateway', [AdminConfigController::class, 'gateway'])->name('gateway');
    Route::post('gateway', [AdminConfigController::class, 'salvarGateway'])->name('gateway.salvar');
});

