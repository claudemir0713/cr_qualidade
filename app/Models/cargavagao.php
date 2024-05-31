<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargavagao extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'data'
        , 'user_id'
        , 'produto_id'
        , 'extrusora_id'
        , 'peso'
        , 'dim_externa'
        , 'dim_parede'
        , 'umidade'
        , 'resistencia'
        , 'perda'
        , 'historico_id'

    ];
    protected $primaryKey = 'id';
    protected $table = 'cargavagao';

}
