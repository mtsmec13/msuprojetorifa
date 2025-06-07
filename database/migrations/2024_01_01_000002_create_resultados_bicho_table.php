<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resultados_bicho', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('numero_sorteado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resultados_bicho');
    }
};