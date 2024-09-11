<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['livro_id', 'cliente_nome', 'quantidade', 'preco_total', 'status'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }
}
