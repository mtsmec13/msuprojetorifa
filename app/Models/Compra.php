<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'rifa_id',
        'nome_comprador',
        'telefone',
        'email',
        'numeros_escolhidos',
        'confirmado',
    ];

    protected $casts = [
        'numeros_escolhidos' => 'array',
        'confirmado' => 'boolean',
    ];

    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }
}
