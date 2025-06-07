<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Use Carbon para lidar com datas

class ConfiguracoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela antes de inserir para evitar duplicatas
        DB::table('configuracoes')->truncate();

        // Insere o registro na tabela 'configuracoes' COM AS COLUNAS CORRETAS
        DB::table('configuracoes')->insert([
            'nome_rifa' => 'Rifa de Lançamento',
            'descricao_rifa' => 'Concorra a um prêmio fantástico no lançamento do nosso site!',
            'valor_bilhete' => 10.00,
            'quantidade_bilhetes' => 1000,
            'data_sorteio' => Carbon::now()->addMonths(3),
            'premio' => 'Pix de R$ 500,00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
