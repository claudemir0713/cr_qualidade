<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProdutoLaboratorio extends Migration
{

    public function up()
    {
        Schema::table('laboratorio', function (Blueprint $table) {
            $table->integer('produto_id')->index()->nullable();
        });
    }


}
