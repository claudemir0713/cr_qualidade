<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function(Blueprint $table){
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->string('ordem',20)->nullable();
            $table->string('descricao',100)->nullable();
            $table->string('tipo',100)->nullable();
            $table->string('rota',100)->nullable();
            $table->string('icone',100)->nullable();

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
        Schema::dropIfExists('menu');
    }
}
