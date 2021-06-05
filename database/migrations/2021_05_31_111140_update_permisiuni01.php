<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePermisiuni01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('disponibilitateArticole', function (Blueprint $table) {
            $table->dropcolumn('functieID');
        });
    }

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::table('disponibilitateArticole', function (Blueprint $table) {
        $table->integer('functieID')->nullable();
    });
}
}
