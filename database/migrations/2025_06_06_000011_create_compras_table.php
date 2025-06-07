<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rifa_id')->constrained()->onDelete('cascade');
            $table->string('nome_comprador');
            $table->string('telefone');
            $table->string('email')->nullable();
            $table->json('numeros_escolhidos');
            $table->boolean('confirmado')->default(false);
            $table->integer('numero')->nullable(); // <-- NOVA COLUNA
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('compras');
    }
};