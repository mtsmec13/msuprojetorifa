
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicacoesTable extends Migration
{
    public function up()
    {
        Schema::create('indicacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id'); // quem indicou
            $table->unsignedBigInteger('indicado_id'); // quem foi indicado
            $table->decimal('bonus', 8, 2)->default(0);
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('indicado_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicacoes');
    }
}
