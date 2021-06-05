<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permisiuniArticol extends Model
{
    protected $table = 'disponibilitateArticole';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
}
