<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extrusora_imagem extends Model
{
    use HasFactory;
    protected $fillable= [
        'id'
        , 'extrusora_id'
        , 'anexo'

    ];
    protected $primaryKey = 'id';
    protected $table = 'extrusora_imagem';

}
