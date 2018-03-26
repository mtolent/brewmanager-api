<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtractConv extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'extract_conv';

	protected $fillable = array('mass', 'vol');
}
