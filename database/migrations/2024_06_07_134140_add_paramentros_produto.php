<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParamentrosProduto extends Migration
{
    public function up()
    {
        Schema::table('produto', function (Blueprint $table) {
            $table->double('extrusora_pesoi',8,2)->nullable();
            $table->double('extrusora_pesos',8,2)->nullable();
            $table->double('extrusora_alturai',8,2)->nullable();
            $table->double('extrusora_alturas',8,2)->nullable();
            $table->double('extrusora_largurai',8,2)->nullable();
            $table->double('extrusora_larguras',8,2)->nullable();
            $table->double('extrusora_comprimentoi',8,2)->nullable();
            $table->double('extrusora_comprimentos',8,2)->nullable();
            $table->double('extrusora_dim_paredei',8,2)->nullable();
            $table->double('extrusora_dim_paredes',8,2)->nullable();
            $table->double('extrusora_umidadei',8,2)->nullable();
            $table->double('extrusora_umidades',8,2)->nullable();
            $table->double('extrusora_vacuoi',8,2)->nullable();
            $table->double('extrusora_vacuos',8,2)->nullable();
            $table->double('extrusora_durometroi',8,2)->nullable();
            $table->double('extrusora_durometros',8,2)->nullable();
            $table->double('cargavagao_pesoi',8,2)->nullable();
            $table->double('cargavagao_pesos',8,2)->nullable();
            $table->double('cargavagao_dim_externai',8,2)->nullable();
            $table->double('cargavagao_dim_externas',8,2)->nullable();
            $table->double('cargavagao_dim_paredei',8,2)->nullable();
            $table->double('cargavagao_dim_paredes',8,2)->nullable();
            $table->double('cargavagao_umidadei',8,2)->nullable();
            $table->double('cargavagao_umidades',8,2)->nullable();
            $table->double('cargavagao_resistenciai',8,2)->nullable();
            $table->double('cargavagao_resistencias',8,2)->nullable();
            $table->double('forno_pesoi',8,2)->nullable();
            $table->double('forno_pesos',8,2)->nullable();
            $table->double('forno_dim_paredei',8,2)->nullable();
            $table->double('forno_dim_paredes',8,2)->nullable();
            $table->double('forno_resistenciai',8,2)->nullable();
            $table->double('forno_resistencias',8,2)->nullable();
            $table->double('forno_absorcaoi',8,2)->nullable();
            $table->double('forno_absorcaos',8,2)->nullable();
            $table->double('laboratorio_resistenciai',8,2)->nullable();
            $table->double('laboratorio_resistencias',8,2)->nullable();
            $table->double('laboratorio_absorcaoi',8,2)->nullable();
            $table->double('laboratorio_absorcaos',8,2)->nullable();
            $table->double('laboratorio_largurai',8,2)->nullable();
            $table->double('laboratorio_larguras',8,2)->nullable();
            $table->double('laboratorio_alturai',8,2)->nullable();
            $table->double('laboratorio_alturas',8,2)->nullable();
            $table->double('laboratorio_comprimentoi',8,2)->nullable();
            $table->double('laboratorio_comprimentos',8,2)->nullable();
            $table->double('laboratorio_parede_externai',8,2)->nullable();
            $table->double('laboratorio_parede_externas',8,2)->nullable();
            $table->double('laboratorio_septosi',8,2)->nullable();
            $table->double('laboratorio_septoss',8,2)->nullable();
            $table->double('laboratorio_planezai',8,2)->nullable();
            $table->double('laboratorio_planezas',8,2)->nullable();
            $table->double('laboratorio_esquadroi',8,2)->nullable();
            $table->double('laboratorio_esquadros',8,2)->nullable();
            $table->double('laboratorio_densidadei',8,2)->nullable();
            $table->double('laboratorio_densidades',8,2)->nullable();


        });
    }


}
