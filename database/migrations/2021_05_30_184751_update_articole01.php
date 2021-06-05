<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArticole01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('articole', function (Blueprint $table) {
            $table->text('text')->change();
            $table->string('codIdentificare', 8)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articole', function (Blueprint $table) {
            $table->string('text')->change();
        });
    }
}
