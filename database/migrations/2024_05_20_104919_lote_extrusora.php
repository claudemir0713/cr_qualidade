<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoteExtrusora extends Migration
{

    public function up()
    {
        Schema::table('extrusora', function (Blueprint $table) {
            $table->string('lote',50)->nullable();
        });
    }


}
