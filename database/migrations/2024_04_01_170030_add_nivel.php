<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNivel extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ativo',1)->default('S');
            $table->string('nivel',10)->default('admin');
        });
    }


}
