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
        , 'peso'
        , 'resistencia'
    ];
    protected $primaryKey = 'id';
    protected $table = 'laboratorio';

}
