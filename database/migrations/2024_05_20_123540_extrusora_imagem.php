<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtrusoraImagem extends Migration
{
    public function up()
    {
        Schema::create('extrusora_imagem', function(Blueprint $table){
            $table->increments('id');
            $table->integer('extrusora_id')->index()->nullable();
            $table->string('anexo',225)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extrusora_imagem');
    }
}

