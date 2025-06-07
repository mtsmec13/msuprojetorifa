
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicacao extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'indicado_id', 'bonus'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function indicado()
    {
        return $this->belongsTo(User::class, 'indicado_id');
    }
}
