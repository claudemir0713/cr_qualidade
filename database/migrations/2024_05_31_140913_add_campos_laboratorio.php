<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposLaboratorio extends Migration
{
    public function up()
    {
        Schema::table('laboratorio', function (Blueprint $table) {
            $table->double('largura',8,2)->nullable();
            $table->double('altura',8,2)->nullable();
            $table->double('comprimento',8,2)->nullable();
            $table->double('parede_ext',8,2)->nullable();
            $table->double('septos',8,2)->nullable();
            $table->double('planeza',8,2)->nullable();
            $table->double('esquadro',8,2)->nullable();
            $table->double('densidade',8,2)->nullable();
        });
    }


}
