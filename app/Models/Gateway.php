
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'status',
        'client_id',
        'client_secret',
        'chave_pix',
        'webhook_url'
    ];
}
