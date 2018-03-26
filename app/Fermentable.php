<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fermentable extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'fermentables';

	protected $fillable = array('name','version','type','amount','yield','color','add_after_boil',
								'origin','supplier','coarse_fine_diff','moisture','diastatic_power','protein',
								'max_in_batch','recommend_mash','ibu_gal_per_lb','potential',);
}
