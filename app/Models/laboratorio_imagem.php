<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laboratorio_imagem extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'laboratorio_id'
        , 'anexo'

    ];
    protected $primaryKey = 'id';
    protected $table = 'laboratorio_imagem';

}
