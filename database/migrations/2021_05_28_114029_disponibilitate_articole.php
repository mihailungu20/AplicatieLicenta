<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DisponibilitateArticole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilitateArticole', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('articolID');
            $table->integer('departamentID');
            $table->integer('functieID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilitateArticole');
    }
}
