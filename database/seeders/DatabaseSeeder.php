<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Aqui você informa todos os seeders que quer executar
        $this->call([
            ConfiguracoesSeeder::class,
            AdminSeeder::class,
            // Se você criar outro seeder, adicione aqui:
            // OutroSeeder::class,
        ]);
    }
}
