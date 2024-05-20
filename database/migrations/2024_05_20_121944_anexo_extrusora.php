<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnexoExtrusora extends Migration
{
    public function up()
    {
        Schema::table('extrusora', function (Blueprint $table) {
            $table->string('anexo',225)->nullable();
        });
    }


}
