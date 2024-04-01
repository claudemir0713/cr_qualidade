<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtrusorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('extrusora', function(Blueprint $table){
        $table->increments('id');
        $table->date('data')->nullable();
        $table->time('user_id')->nullable();
        $table->integer('produto')->nullable();
        $table->integer('peso')->nullable();
        $table->integer('dim_externa')->nullable();
        $table->integer('dim_parede')->nullable();
        $table->integer('vacuo')->nullable();
        $table->integer('durometro')->nullable();
        $table->integer('residuo')->nullable();
        $table->string('turno',1)->nullable();

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
        Schema::dropIfExists('extrusora');
    }
}

