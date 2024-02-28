<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordembaixa extends Model
{
    use HasFactory;
    protected $fillable= [
        'CodBaixa'
        , 'CodOrdem'
        , 'DataApontamento'
        , 'QntGrade'
        , 'QntPeca'
        , 'CodOperador'

    ];
    protected $primaryKey = 'CodBaixa';
    protected $table = 'OrdemBaixa';

}
