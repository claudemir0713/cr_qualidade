<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    use HasFactory;
    protected $fillable= [
        'CodProd'
        , 'Produto'
        , 'QntGrade'
        , 'CodPro'


    ];
    protected $primaryKey = 'CodProd';
    protected $table = 'Produto';

}
