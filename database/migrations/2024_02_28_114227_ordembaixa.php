<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ordembaixa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('OrdemBaixa', function(Blueprint $table){
        $table->increments('CodBaixa');
        $table->integer('CodOrdem')->nullable();
        $table->date('DataApontamento')->nullable();
        $table->integer('QntGrade')->nullable();
        $table->integer('QntPeca')->nullable();
        $table->integer('CodOperador')->nullable();

        $table->softDeletes();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OrdemBaixa');
    }
}
