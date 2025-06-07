<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('numeros', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira para ligar o número à rifa
            $table->foreignId('rifa_id')
                  ->constrained('rifas') // Liga com a tabela 'rifas'
                  ->onDelete('cascade'); // Se a rifa for apagada, os números também são

            // O número da rifa (ex: 1, 2, 55, 123)
            $table->unsignedInteger('numero'); 
            
            // O status do número
            $table->string('status')->default('Disponivel'); // Ex: Disponivel, Reservado, Pago

            // Opcional: a quem pertence este número
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numeros');
    }
};

