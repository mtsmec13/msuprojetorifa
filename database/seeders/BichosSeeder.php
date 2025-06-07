<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BichosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bichos')->insert([
            ['nome' => 'Cachorro', 'imagem' => 'bichos/cachorro.png'],
            ['nome' => 'Gato', 'imagem' => 'bichos/gato.png'],
            ['nome' => 'Papagaio', 'imagem' => 'bichos/papagaio.png'],
        ]);
    }
}
