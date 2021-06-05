<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateArticol extends Model
{
    protected $table = 'templateArticole';
    protected $primaryKey = 'id';

    public function getDateFormat()
	{
    	return 'Y-m-d H:i:s';
	}
}
