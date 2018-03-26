<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Hop extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'hops';

	protected $fillable = array('name', 'comments', 'version','origin','alpha','amount','use','time','notes','type',
							    'form','beta','hsi');


}
