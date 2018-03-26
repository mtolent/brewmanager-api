<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'equipments';

	protected $casts = [
		'calc_boil_volume' => 'boolean',
	];

	protected $fillable = array('name',	'volume', 'addition', 'loss', 'loss_pct');
		
	public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }
}



