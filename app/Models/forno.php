<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forno extends Model
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
        , 'residuo'
        , 'absorcao'
        , 'cod_residuo'
        , 'historico_id'


    ];
    protected $primaryKey = 'id';
    protected $table = 'forno';

}
