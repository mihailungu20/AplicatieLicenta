<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DepartamentSeeder extends Seeder
{
    public function run()
    {
        DB::table('departamente')->insert([
        	'id' => 1,
            'denumire' => 'IT',
            'cod' => 'IT',
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}
