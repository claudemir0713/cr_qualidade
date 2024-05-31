<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedidaforno extends Migration
{

    public function up()
    {
        Schema::table('forno', function (Blueprint $table) {
            $table->double('absorcao',8,2)->nullable();
            $table->double('cod_residuo',8,2)->nullable();
            $table->integer('historico_id')->index()->nullable();
        });
    }


}
