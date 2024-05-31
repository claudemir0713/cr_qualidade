<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('laboratorio', function(Blueprint $table){
        $table->increments('id');
        $table->date('data')->nullable();
        $table->integer('user_id')->index()->nullable();
        $table->double('absorcao',8,2)->nullable();
        $table->double('resistencia',8,2)->nullable();

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
        Schema::dropIfExists('laboratorio');
    }
}

