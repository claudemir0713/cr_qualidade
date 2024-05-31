<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedidaforno extends Migration
{

    public function up()
    {
        Schema::table('forno', function (Blueprint $table) {
            $table->integer('absorcao')->nullable();
            $table->integer('cod_residuo')->nullable();
            $table->integer('historico_id')->index()->nullable();
        });
    }


}
