<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class Yeast extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'yeasts';

	protected $fillable = array('name', 'version','type','form','laboratory','min_temp','max_temp',
	'floculation','attenuation','notes','max_reuse');


}