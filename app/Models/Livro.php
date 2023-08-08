<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo', 'autor','ano_publicacao',
        'cep', 'cidade', 'estado','bairro',
        'rua','numero','complemento','descricao',
        'nome_imagem', 'isbn',
    ];
}
