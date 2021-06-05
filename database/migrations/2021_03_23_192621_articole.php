<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('articole', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titlu', 64);
            $table->string('text');
            $table->integer('categorieID');
            $table->boolean('aprobat')->nullable();
            $table->integer('aprobat_de')->nullable();
            $table->string('aprobat_la', 24)->nullable();
            $table->integer('codIdentificare');
            $table->string('cuvinteCautare')->nullable();
            $table->integer('creat_de');
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
        Schema::dropIfExists('articole');
    }
}
