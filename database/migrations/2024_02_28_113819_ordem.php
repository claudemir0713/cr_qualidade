<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ordem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ordem', function(Blueprint $table){
            $table->increments('CodOrdem');
            $table->date('DataInicio')->nullable();
            $table->date('DataConclusao')->nullable();
            $table->integer('Produto')->nullable();
            $table->integer('Maquina')->nullable();
            $table->integer('Quantidade')->nullable();

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
        Schema::dropIfExists('Ordem');
    }
}
