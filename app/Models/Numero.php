<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    use HasFactory;

    /**
     * O nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'numeros'; // Certifique-se de que o nome da sua tabela é este.

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rifa_id',
        'pedido_id',
        'numero',
        'status', // Ex: 'Disponivel', 'Reservado', 'Vendido'
    ];

    /**
     * Define a relação inversa com a Rifa.
     * Um número pertence a uma Rifa.
     */
    public function rifa()
    {
        return $this->belongsTo(Rifa::class);
    }

    /**
     * Define a relação inversa com o Pedido.
     * Um número pode pertencer a um Pedido.
     */
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}

