<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departamente';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
    //
}
