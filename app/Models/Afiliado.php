
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    protected $fillable = ['afiliado_id', 'referencia_compra_id', 'comissao'];

    public function afiliado()
    {
        return $this->belongsTo(User::class, 'afiliado_id');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'referencia_compra_id');
    }
}
