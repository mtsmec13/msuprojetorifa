<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoBicho extends Model
{
    protected $table = 'resultados_bicho';
    protected $fillable = ['data', 'numero_sorteado'];

    public function getDezenaAttribute()
    {
        return str_pad($this->numero_sorteado % 100, 2, '0', STR_PAD_LEFT);
    }

    public function getBichoIndexAttribute()
    {
        return (int)ceil($this->numero_sorteado / 4);
    }

    public function getBichoAttribute()
    {
        $bichos = [
            1 => ['Avestruz', 'avestruz.png'],
            2 => ['Águia', 'aguia.png'],
            3 => ['Burro', 'burro.png'],
            4 => ['Borboleta', 'borboleta.png'],
            5 => ['Cachorro', 'cachorro.png'],
            6 => ['Cabra', 'cabra.png'],
            7 => ['Carneiro', 'carneiro.png'],
            8 => ['Camelo', 'camelo.png'],
            9 => ['Cobra', 'cobra.png'],
            10 => ['Coelho', 'coelho.png'],
            11 => ['Cavalo', 'cavalo.png'],
            12 => ['Elefante', 'elefante.png'],
            13 => ['Galo', 'galo.png'],
            14 => ['Gato', 'gato.png'],
            15 => ['Jacaré', 'jacare.png'],
            16 => ['Leão', 'leao.png'],
            17 => ['Macaco', 'macaco.png'],
            18 => ['Porco', 'porco.png'],
            19 => ['Pavão', 'pavao.png'],
            20 => ['Peru', 'peru.png'],
            21 => ['Touro', 'touro.png'],
            22 => ['Tigre', 'tigre.png'],
            23 => ['Urso', 'urso.png'],
            24 => ['Veado', 'veado.png'],
            25 => ['Vaca', 'vaca.png'],
        ];
        return $bichos[$this->bicho_index] ?? ['Desconhecido', 'desconhecido.png'];
    }
}