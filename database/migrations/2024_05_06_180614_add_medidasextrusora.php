<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedidasextrusora extends Migration
{

    public function up()
    {
        Schema::table('extrusora', function (Blueprint $table) {
            $table->double('altura',8,2)->nullable();
            $table->double('largura',8,2)->nullable();
            $table->double('comprimento',8,2)->nullable();
            $table->double('umidade',8,2)->nullable();
        });
    }


}
