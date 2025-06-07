<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracao extends Model
{
    protected $table = 'configuracoes'; // Specify the table name
    protected $fillable = ['chave', 'valor'];
    public $timestamps = false; // Disable if your table doesn't have timestamps

    public static function get($chave, $default = null)
    {
        return static::where('chave', $chave)->value('valor') ?? $default;
    }

    public static function set($chave, $valor)
    {
        return static::updateOrCreate(['chave' => $chave], ['valor' => $valor]);
    }
}