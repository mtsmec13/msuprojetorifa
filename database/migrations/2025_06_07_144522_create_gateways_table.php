<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaysTable extends Migration
{
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable(); // efi, pagseguro, pagbank, etc.
            $table->string('chave')->nullable(); // Chave Pix, client_id, etc.
            $table->string('token')->nullable(); // Token secreto
            $table->string('client_secret')->nullable();
            $table->string('certificado_pix')->nullable();
            $table->string('private_key_pix')->nullable();
            $table->string('webhook_url')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_business')->nullable();
            $table->boolean('sandbox')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gateways');
    }
}