<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('rifas', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->string('status')->default('ativa')->after('id');
    });
}

public function down()
{
    Schema::table('rifas', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropColumn('status');
    });
}
};