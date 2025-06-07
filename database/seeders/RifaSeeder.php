<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rifa;

class RifaSeeder extends Seeder
{
    public function run()
    {
        Rifa::create([
            'nome' => 'Rifa do iPhone 15',
            'descricao' => 'Concorra a um iPhone 15 novinho!',
            'quantidade_numeros' => 100,
            'preco' => 10.00,
            'data_sorteio' => now()->addDays(10),
            'premio_1' => 'iPhone 15',
            'premio_2' => 'Fone Bluetooth',
            'premio_3' => 'Capinha Personalizada',
        ]);

        Rifa::create([
            'nome' => 'Rifa do PlayStation 5',
            'descricao' => 'Ganhe um PS5 na faixa!',
            'quantidade_numeros' => 150,
            'preco' => 15.00,
            'data_sorteio' => now()->addDays(20),
            'premio_1' => 'PlayStation 5',
            'premio_2' => 'Controle extra',
            'premio_3' => 'Headset gamer',
        ]);
    }
}
