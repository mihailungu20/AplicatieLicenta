<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articol extends Model
{
    protected $table = 'articole';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
}
