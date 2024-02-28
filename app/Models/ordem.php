<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordem extends Model
{
    use HasFactory;
    protected $fillable= [
        'CodOrdem'
        , 'DataInicio'
        , 'DataConclusao'
        , 'CodProd'
        , 'CodMaquina'
        , 'QntProducao'
        , 'QntProduzida'
        , 'QntSaldo'
        , 'Status'
        , 'CodEncerramento'

    ];
    protected $primaryKey = 'CodOrdem';
    protected $table = 'Ordem';

}
