<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicRifaController;
use App\Http\Controllers\PublicBichoController;
use App\Http\Controllers\PainelJogadorController;
use App\Http\Controllers\AdminRifaController;
use App\Http\Controllers\AdminCompraController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminConfigController;
use App\Http\Controllers\AdminBichoController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/rifas', [AdminController::class, 'rifas'])->name('admin.rifas');
    Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/compras', [AdminController::class, 'compras'])->name('admin.compras');
    Route::get('/configuracoes', [AdminController::class, 'configuracoes'])->name('admin.configuracoes');
    Route::post('/configuracoes', [AdminController::class, 'salvarConfiguracoes'])->name('admin.configuracoes.salvar');
    Route::get('/gateway', [AdminController::class, 'gateway'])->name('admin.gateway');
    Route::post('/gateway', [AdminController::class, 'salvarGateway'])->name('admin.gateway.salvar');
});

Route::get('/dashboard', [PublicRifaController::class, 'dashboard'])->name('dashboard');
// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rota para exibir o detalhe da rifa (provavelmente já existe)
Route::get('/rifas/{id}', [PublicRifaController::class, 'show'])->name('public.rifas.show');

// Rota para reservar/comprar um número na rifa
Route::post('/rifas/{id}/reservar', [PublicRifaController::class, 'reservar'])->name('rifa.reservar');

// Rifas públicas (listagem e detalhes)
Route::get('/rifas', [PublicRifaController::class, 'index'])->name('public.rifas.index');
Route::get('/rifas/{rifa}', [PublicRifaController::class, 'show'])->name('public.rifas.show');

// Página do resultado do Jogo do Bicho
Route::get('/bicho', [PublicBichoController::class, 'index'])->name('bicho.resultado');

// Página de detalhes/participação da rifa (compra)
Route::get('/rifa/{id}', [HomeController::class, 'show'])->name('rifa.show');
Route::post('/rifa/{id}/comprar', [HomeController::class, 'comprar'])->name('rifa.comprar');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO (LARAVEL BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php'; // Breeze já cria login, registro, logout, etc

/*
|--------------------------------------------------------------------------
| PAINEL DO JOGADOR (AUTENTICADO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/painel', [PainelJogadorController::class, 'index'])->name('painel');
});

/*
|--------------------------------------------------------------------------
| PAINEL ADMINISTRATIVO (PROTEGIDO PELO MIDDLEWARE 'admin')
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Rifas (CRUD)
    Route::get('rifas', [AdminRifaController::class, 'index'])->name('admin.rifas.index');
    Route::get('rifas/create', [AdminRifaController::class, 'create'])->name('admin.rifas.create');
    Route::post('rifas', [AdminRifaController::class, 'store'])->name('admin.rifas.store');
    Route::get('rifas/{rifa}/edit', [AdminRifaController::class, 'edit'])->name('admin.rifas.edit');
    Route::put('rifas/{rifa}', [AdminRifaController::class, 'update'])->name('admin.rifas.update');
    Route::delete('rifas/{rifa}', [AdminRifaController::class, 'destroy'])->name('admin.rifas.destroy');
    Route::get('rifas/{rifa}/compras', [AdminRifaController::class, 'compras'])->name('admin.rifas.compras');
    Route::post('rifas/{rifa}/vencedores', [AdminRifaController::class, 'definirVencedores'])->name('admin.rifas.vencedores');
    Route::post('rifas/{rifa}/sortear', [AdminRifaController::class, 'sortear'])->name('admin.rifas.sortear');
    // Compras (listagem/remoção)
    Route::get('compras', [AdminCompraController::class, 'index'])->name('admin.compras.index');
    Route::get('compras/{compra}', [AdminCompraController::class, 'show'])->name('admin.compras.show');
    Route::delete('compras/{compra}', [AdminCompraController::class, 'destroy'])->name('admin.compras.destroy');
    // Usuários
    Route::get('usuarios', [AdminUserController::class, 'index'])->name('admin.usuarios.index');
    Route::get('usuarios/{user}', [AdminUserController::class, 'show'])->name('admin.usuarios.show');
    Route::put('usuarios/{user}/inativar', [AdminUserController::class, 'inativar'])->name('admin.usuarios.inativar');
    // Configurações
    Route::get('config', [AdminConfigController::class, 'index'])->name('admin.config.index');
    Route::post('config', [AdminConfigController::class, 'store'])->name('admin.config.store');
    // Jogo do Bicho (admin)
    Route::get('bicho', [AdminBichoController::class, 'index'])->name('admin.bicho.index');
    Route::get('bicho/create', [AdminBichoController::class, 'create'])->name('admin.bicho.create');
    Route::post('bicho', [AdminBichoController::class, 'store'])->name('admin.bicho.store');
});


// Webhooks Pix para cada gateway
Route::post('/webhook/pagbank', [\App\Http\Controllers\WebhookController::class, 'pagbank']);
Route::post('/webhook/efi', [\App\Http\Controllers\WebhookController::class, 'efi']);
Route::post('/webhook/paggue', [\App\Http\Controllers\WebhookController::class, 'paggue']);
Route::post('/webhook/suitpay', [\App\Http\Controllers\WebhookController::class, 'suitpay']);


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/configuracoes', [\App\Http\Controllers\Admin\ConfiguracoesController::class, 'index'])->name('admin.configuracoes');
    Route::post('/configuracoes', [\App\Http\Controllers\Admin\ConfiguracoesController::class, 'salvar'])->name('admin.configuracoes.salvar');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/afiliados', [\App\Http\Controllers\Admin\AfiliadosController::class, 'index'])->name('admin.afiliados');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/meu-link', [\App\Http\Controllers\AfiliadoController::class, 'meuLink'])->name('afiliado.link');
});

// Gateways RESERVAS
Route::post('/rifas/{id}/reservar-pix-efi', [PublicRifaController::class, 'reservarPixEfi'])->name('rifa.reservar.pix.efi');
Route::post('/efi/pix/webhook', [PublicRifaController::class, 'efiPixWebhook'])->name('efi.pix.webhook');
Route::post('/rifas/{id}/reservar-pix-pagbank', [PublicRifaController::class, 'reservarPixPagbank'])->name('rifa.reservar.pix.pagbank');
Route::post('/pagbank/pix/webhook', [PublicRifaController::class, 'pagbankPixWebhook'])->name('pagbank.pix.webhook');