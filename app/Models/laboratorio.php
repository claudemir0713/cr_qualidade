<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laboratorio extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'data'
        , 'user_id'
        , 'absorcao'
        , 'resistencia'
        , 'extrusora_id'
        , 'produto_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'laboratorio';

}
