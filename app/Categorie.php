<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $table = 'categorii';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
}
