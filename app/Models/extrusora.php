<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extrusora extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'data'
        , 'user_id'
        , 'produto_id'
        , 'peso'
        , 'dim_externa'
        , 'dim_parede'
        , 'vacuo'
        , 'durometro'
        , 'turno'
        , 'altura'
        , 'largura'
        , 'comprimento'
        , 'umidade'
        , 'lote'
        , 'anexo'

    ];
    protected $primaryKey = 'id';
    protected $table = 'extrusora';

}
