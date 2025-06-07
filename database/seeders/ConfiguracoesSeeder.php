<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracoesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('configuracoes')->insert([
            ['chave' => 'site_nome', 'valor' => 'Sistema de Rifas'],
            ['chave' => 'email_contato', 'valor' => 'contato@exemplo.com'],
            ['chave' => 'whatsapp_suporte', 'valor' => '+55999999999'],
        ]);
    }
}
