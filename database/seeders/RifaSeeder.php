<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rifa;
use App\Models\Numero;

class RifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Limpa as tabelas para evitar dados duplicados ao executar várias vezes
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rifa::truncate();
        Numero::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- RIFA 1: ATIVA (iPhone) ---
        // A linha 'imagem_url' foi removida para ser compatível com a sua tabela
        $rifa1 = Rifa::create([
            'nome' => 'iPhone 15 Pro Max (256GB)',
            'descricao' => 'Leve para casa o último lançamento da Apple. O telemóvel mais desejado do mundo!',
            'preco' => 5.00,
            'quantidade_numeros' => 500,
            'status' => 'Ativo',
            'data_sorteio' => now()->addDays(30),
        ]);

        // Cria os números para a Rifa 1
        $numerosRifa1 = [];
        for ($i = 0; $i < $rifa1->quantidade_numeros; $i++) {
            $numerosRifa1[] = [
                'rifa_id' => $rifa1->id,
                'numero' => $i,
                'status' => 'Disponivel',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Numero::insert($numerosRifa1);

        // Vende aleatoriamente 30% dos números da Rifa 1 para teste
        Numero::where('rifa_id', $rifa1->id)
              ->inRandomOrder()
              ->limit((int)($rifa1->quantidade_numeros * 0.3)) // Vende 30%
              ->update(['status' => 'Vendido']);


        // --- RIFA 2: ATIVA (PIX) ---
        $rifa2 = Rifa::create([
            'nome' => 'PIX de R$ 1.000 na sua Conta!',
            'descricao' => 'A oportunidade de ganhar mil reais para usar como quiser. Simples e rápido!',
            'preco' => 2.50,
            'quantidade_numeros' => 1000,
            'status' => 'Ativo',
            'data_sorteio' => now()->addDays(20),
        ]);
        $numerosRifa2 = [];
        for ($i = 0; $i < $rifa2->quantidade_numeros; $i++) {
            $numerosRifa2[] = ['rifa_id' => $rifa2->id, 'numero' => $i, 'status' => 'Disponivel', 'created_at' => now(), 'updated_at' => now()];
        }
        Numero::insert($numerosRifa2);

        // Vende aleatoriamente 70% dos números da Rifa 2
        Numero::where('rifa_id', $rifa2->id)->inRandomOrder()->limit((int)($rifa2->quantidade_numeros * 0.7))->update(['status' => 'Vendido']);

        // --- RIFA 3: FINALIZADA ---
        $rifa3 = Rifa::create([
            'nome' => 'Moto Honda 0km na Garagem',
            'descricao' => 'Uma moto novinha para acelerar os seus sonhos.',
            'preco' => 10.00,
            'quantidade_numeros' => 2000,
            'status' => 'Finalizada',
            'data_sorteio' => now()->subDays(5),
        ]);
    }
}

