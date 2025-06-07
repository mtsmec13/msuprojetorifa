<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracoesSeeder extends Seeder
{
    public function run()
    {
        DB::table('configuracoes')->insert([
            ['chave' => 'site_nome', 'valor' => 'Sistema de Rifas'],
            ['chave' => 'email_contato', 'valor' => 'contato@exemplo.com'],
            ['chave' => 'whatsapp_suporte', 'valor' => '+55999999999'],
            ['chave' => 'tema', 'valor' => 'dark'],
            ['chave' => 'logo', 'valor' => null],
            ['chave' => 'favicon', 'valor' => null],
            ['chave' => 'cor_principal', 'valor' => '#FFD600'],
            ['chave' => 'cor_secundaria', 'valor' => '#18181b'],
            ['chave' => 'manutencao', 'valor' => '0'],
        ]);
    }
}
