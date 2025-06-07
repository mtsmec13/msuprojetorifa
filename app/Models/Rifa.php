<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Numero;

class Rifa extends Model
{
    use HasFactory;
    
    // Lista de colunas da SUA migration
    protected $fillable = [
        'nome',
        'descricao',
        'imagem_url',
        'quantidade_numeros',
        'preco',
        'data_sorteio',
        'status',
        // ... e as outras colunas que você definiu
    ];

    // --- Relações ---
    public function numeros() {
        return $this->hasMany(Numero::class);
    }

    public function numerosVendidos() {
        return $this->hasMany(Numero::class)->whereIn('status', ['Vendido', 'Pago']);
    }

    // --- Acessors para compatibilidade com a View ---

    // Cria um 'titulo' virtual a partir da sua coluna 'nome'
    protected function titulo(): Attribute {
        return Attribute::make( get: fn ($value, $attributes) => $attributes['nome'] );
    }

    // Cria uma 'descricao_curta' virtual a partir da sua coluna 'descricao'
    protected function descricaoCurta(): Attribute {
        return Attribute::make( get: fn ($value, $attributes) => $attributes['descricao'] );
    }

    // Cria um 'valor_numero' virtual a partir da sua coluna 'preco'
    protected function valorNumero(): Attribute {
        return Attribute::make( get: fn ($value, $attributes) => $attributes['preco'] );
    }
    
    // Acessor para a contagem de números vendidos (essencial)
    protected function numerosVendidosCount(): Attribute {
        return Attribute::make( get: fn () => $this->numerosVendidos()->count() );
    }
}

