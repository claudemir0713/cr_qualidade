<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cargavagao_imagem extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'cargavagao_id'
        , 'anexo'

    ];
    protected $primaryKey = 'id';
    protected $table = 'cargavagao_imagem';

}
