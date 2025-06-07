
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->boolean('status')->default(false);
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('chave_pix')->nullable();
            $table->string('webhook_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('gateways');
    }
};
