<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('forno', function(Blueprint $table){
        $table->increments('id');
        $table->date('data')->nullable();
        $table->integer('user_id')->index()->nullable();
        $table->integer('produto_id')->index()->nullable();
        $table->integer('extrusora_id')->index()->nullable();
        $table->integer('peso')->nullable();
        $table->integer('dim_externa')->nullable();
        $table->integer('dim_parede')->nullable();
        $table->integer('umidade')->nullable();
        $table->integer('resistencia')->nullable();
        $table->string('residuo',100)->nullable();

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
        Schema::dropIfExists('forno');
    }
}

