<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedidacargavagao extends Migration
{

    public function up()
    {
        Schema::table('cargavagao', function (Blueprint $table) {
            $table->double('perda',8,2)->nullable();
            $table->integer('historico_id')->index()->nullable();
        });
    }


}
