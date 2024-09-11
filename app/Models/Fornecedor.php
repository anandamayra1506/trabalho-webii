<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores'; 

    protected $fillable = [
        'empresa',
        'vendedor',
        'cnpj',
        'endereco',
        'telefone',
        'email',
        'formapg',
        'data',
    ];
}
