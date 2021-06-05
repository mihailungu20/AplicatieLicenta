<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Admin User',
        	'email' => 'admin@local',
        	'administrator' => 1,
            'departamentID' => 1,
        	'password' => Hash::make('Admin1234'),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
    }
}