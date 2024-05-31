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
        $table->integer('user_id')->index()->nullable();
        $table->integer('produto_id')->index()->nullable();
        $table->double('peso',8,2)->nullable();
        $table->double('dim_externa',8,2)->nullable();
        $table->double('dim_parede',8,2)->nullable();
        $table->double('vacuo',8,2)->nullable();
        $table->double('durometro',8,2)->nullable();
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

