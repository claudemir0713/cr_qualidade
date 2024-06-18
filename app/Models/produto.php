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
        , 'extrusora_pesoi'
        , 'extrusora_pesos'
        , 'extrusora_alturai'
        , 'extrusora_alturas'
        , 'extrusora_largurai'
        , 'extrusora_larguras'
        , 'extrusora_comprimentoi'
        , 'extrusora_comprimentos'
        , 'extrusora_dim_paredei'
        , 'extrusora_dim_paredes'
        , 'extrusora_umidadei'
        , 'extrusora_umidades'
        , 'extrusora_vacuoi'
        , 'extrusora_vacuos'
        , 'extrusora_durometroi'
        , 'extrusora_durometros'
        , 'cargavagao_pesoi'
        , 'cargavagao_pesos'
        , 'cargavagao_dim_externai'
        , 'cargavagao_dim_externas'
        , 'cargavagao_dim_paredei'
        , 'cargavagao_dim_paredes'
        , 'cargavagao_umidadei'
        , 'cargavagao_umidades'
        , 'cargavagao_resistenciai'
        , 'cargavagao_resistencias'
        , 'forno_pesoi'
        , 'forno_pesos'
        , 'forno_dim_paredei'
        , 'forno_dim_paredes'
        , 'forno_resistenciai'
        , 'forno_resistencias'
        , 'forno_absorcaoi'
        , 'forno_absorcaos'
        , 'laboratorio_resistenciai'
        , 'laboratorio_resistencias'
        , 'laboratorio_absorcaoi'
        , 'laboratorio_absorcaos'
        , 'laboratorio_largurai'
        , 'laboratorio_larguras'
        , 'laboratorio_alturai'
        , 'laboratorio_alturas'
        , 'laboratorio_comprimentoi'
        , 'laboratorio_comprimentos'
        , 'laboratorio_parede_externai'
        , 'laboratorio_parede_externas'
        , 'laboratorio_septosi'
        , 'laboratorio_septoss'
        , 'laboratorio_planezai'
        , 'laboratorio_planezas'
        , 'laboratorio_esquadroi'
        , 'laboratorio_esquadros'
        , 'laboratorio_densidadei'
        , 'laboratorio_densidades'

    ];
    protected $primaryKey = 'CodProd';
    protected $table = 'produto';

}
