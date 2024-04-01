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
        , 'produto'
        , 'peso'
        , 'dim_externa'
        , 'dim_parede'
        , 'vacuo'
        , 'durometro'
        , 'residuo'
        , 'turno'

    ];
    protected $primaryKey = 'id';
    protected $table = 'extrusora';

}
