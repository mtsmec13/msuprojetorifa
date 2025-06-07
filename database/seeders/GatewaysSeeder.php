<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaysSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gateways')->insert([
            ['nome' => 'PagSeguro', 'tipo' => 'pix', 'chave' => 'your-pagseguro-key', 'ativo' => 1],
            ['nome' => 'Gerencianet', 'tipo' => 'pix', 'chave' => 'your-gerencianet-key', 'ativo' => 0],
            ['nome' => 'MercadoPago', 'tipo' => 'pix', 'chave' => 'your-mercadopago-key', 'ativo' => 0],
            ['nome' => 'Asaas', 'tipo' => 'pix', 'chave' => 'your-asaas-key', 'ativo' => 0],
            ['nome' => 'SuitPay', 'tipo' => 'pix', 'chave' => 'your-suitpay-key', 'ativo' => 0],
            ['nome' => 'Banco do Brasil', 'tipo' => 'pix', 'chave' => 'your-bancodobrasil-key', 'ativo' => 0],
        ]);
    }
}
