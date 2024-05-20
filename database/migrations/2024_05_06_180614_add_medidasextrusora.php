<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedidasextrusora extends Migration
{

    public function up()
    {
        Schema::table('extrusora', function (Blueprint $table) {
            $table->integer('altura')->nullable();
            $table->integer('largura')->nullable();
            $table->integer('comprimento')->nullable();
            $table->integer('umidade')->nullable();
        });
    }


}
