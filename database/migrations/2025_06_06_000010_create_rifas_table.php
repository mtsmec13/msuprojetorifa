<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rifas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->integer('quantidade_numeros');
            $table->decimal('preco', 8, 2);
            $table->dateTime('data_sorteio');
            $table->string('premio_1')->nullable();
            $table->string('premio_2')->nullable();
            $table->string('premio_3')->nullable();
            $table->integer('numero_sorteado_1')->nullable();
            $table->integer('numero_sorteado_2')->nullable();
            $table->integer('numero_sorteado_3')->nullable();
            $table->boolean('mostrar_banner')->default(false);
            $table->boolean('login_obrigatorio')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rifas');
    }
};
