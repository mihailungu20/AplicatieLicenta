<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functie extends Model
{
    protected $table = 'functii';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
}
