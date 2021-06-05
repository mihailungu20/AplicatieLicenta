<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('editor')->nullable();
            $table->boolean('responsabilDepartament')->nullable();
            $table->boolean('administrator')->nullable();
            $table->string('functie', 32)->nullable();
            $table->string('locatie', 32)->nullable();
            $table->string('birou', 32)->nullable();
            $table->string('telefon', 16)->nullable();
            $table->integer('departamentID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropcolumn('editor');
            $table->dropcolumn('responsabilDepartament');
            $table->dropcolumn('administrator');
            $table->dropcolumn('functie');
            $table->dropcolumn('locatie');
            $table->dropcolumn('birou');
            $table->dropcolumn('telefon');
            $table->dropcolumn('departamentID');
        });
    }
}
