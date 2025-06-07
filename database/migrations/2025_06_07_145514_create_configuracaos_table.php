<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// O nome da classe DEVE ser o padrão gerado pelo Laravel
return new class extends Migration
{
    /**
     * Run the migrations.
     * Este método é executado quando você roda `php artisan migrate`
     */
    public function up(): void
    {
        // Cria a tabela 'configuracoes' no banco de dados
        Schema::create('configuracoes', function (Blueprint $table) {
            $table->id(); // Cria uma coluna 'id' auto-incremento
            $table->string('nome_rifa')->default('Minha Rifa Incrível'); // Nome do sorteio
            $table->text('descricao_rifa')->nullable(); // Descrição do sorteio (opcional)
            $table->decimal('valor_bilhete', 8, 2); // Preço do bilhete, ex: 10.50
            $table->integer('quantidade_bilhetes'); // Total de bilhetes disponíveis
            $table->dateTime('data_sorteio'); // Data e hora do sorteio
            $table->string('premio'); // Descrição do prêmio
            $table->timestamps(); // Cria as colunas 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     * Este método é executado quando você roda `php artisan migrate:rollback`
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes');
    }
};
