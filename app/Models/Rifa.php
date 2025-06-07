<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rifa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'quantidade_numeros',
        'preco',
        'data_sorteio',
        'numero_sorteado_1',
        'numero_sorteado_2',
        'numero_sorteado_3',
        'premio_1',
        'premio_2',
        'premio_3',
        'mostrar_banner',
        'login_obrigatorio',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}
