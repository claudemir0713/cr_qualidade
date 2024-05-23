<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoteLaboratorio extends Migration
{

    public function up()
    {
        Schema::table('laboratorio', function (Blueprint $table) {
            $table->integer('lote')->nullable();
        });
    }


}
