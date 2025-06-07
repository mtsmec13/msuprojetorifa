

use App\Http\Controllers\Admin\GatewayController;

Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/gateways', [GatewayController::class, 'index'])->name('gateways.index');
    Route::get('/gateways/{id}/edit', [GatewayController::class, 'edit'])->name('gateways.edit');
    Route::put('/gateways/{id}', [GatewayController::class, 'update'])->name('gateways.update');
});


use App\Http\Controllers\Admin\ConfiguracoesController;

Route::get('/configuracoes', [ConfiguracoesController::class, 'index'])->name('admin.configuracoes.index');
Route::post('/configuracoes/salvar', [ConfiguracoesController::class, 'salvar'])->name('admin.configuracoes.salvar');
