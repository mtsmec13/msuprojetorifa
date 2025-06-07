<?php

namespace Database\Seeders;

// Não precisa de adicionar mais nada aqui
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Esta linha diz ao Laravel para executar o nosso seeder de rifas
        $this->call([
            RifaSeeder::class,
        ]);

        // Você pode adicionar outros seeders aqui no futuro, se precisar.
        // Por exemplo, para criar utilizadores de teste:
        // \App\Models\User::factory(10)->create();
    }
}

