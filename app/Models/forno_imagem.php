<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forno_imagem extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'forno_id'
        , 'anexo'

    ];
    protected $primaryKey = 'id';
    protected $table = 'forno_imagem';

}
