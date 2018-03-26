<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Recipe extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'recipes';

	protected $appends = ['og','total_hop','hop_per_liter','hop_ibu'];

	protected $hidden = ['hops','fermentables'];

	protected $fillable = array('name','comments','batch_size','boil_size','boil_time','efficiency','ibu',
								'dt','brew_date', 'plato', 'evap_rate', 'post_boil_size', 'plato_vol',
								'evap_rate_pct', 'color', 'mash_size', 'mash_loss', 'mash_water_rate', 'mash_id', 'boil_id', 'ferm_id');
            

 	public function fermentables()
	{
			return $this->hasMany('App\RecipeFermentable');
	}

	public function hops()
	{
			return $this->hasMany('App\Recipehop');
	}

	public function boil()
	{
			return $this->belongsTo('App\Equipment', 'boil_id');
	}

	public function mash()
	{
			return $this->belongsTo('App\Equipment', 'mash_id');
	}

	public function getMashTunAttribute()
	{
		return $this->mash;
	}

	public function getEvapRatePctAttribute()
	{
		return $this->attributes['evap_rate'] / 100.0;
	}

	public function getEcrPctAttribute()
	{
		return $this->ecr / 100.0;
	}

	public function getEfficiencyPctAttribute()
	{
		return $this->efficiency / 100.0;
	}

	public function getFermentablesPctAttribute()
	{
        $recipe = BaseModel::create('recipe_fermentables')::where('recipe_id', $this->id);
        return $recipe->get()->sum('percent');
	}

	public function getOgAttribute()
	{
		return round((1 + ($this->plato / (258.6- (227.1 * ($this->plato/258.2))))),3);
	}

	public function getTotalHopAttribute()
	{
		return $this->hops->sum('amount');
	}

	public function getHopIbuAttribute()
	{
		return round($this->hops->sum('ibu'),2);
	}

	public function getHopPerLiterAttribute()
	{
		if ($this->batch_size)
		{
			return round($this->total_hop / $this->batch_size,2);
		}
	}

	public function calcMashWater()
	{
		if ($this->dt && $this->mash_water_rate && $this->mash)
		{
			$this->mash_size = round($this->dt * $this->mash_water_rate + $this->mash->loss, 2);
			$this->mash_size_full = round($this->mash_size + ($this->dt * 0.7), 2);
			$this->mash_loss = round($this->dt * 0.96 + $this->mash->loss, 2);
			$this->sparge_size = round($this->boil_size - $this->mash_size + $this->mash_loss, 2);
		}
	}

	public function calcGrain()
	{
		$total_grain = 0.0;

		$this->ecr = round($this->fermentables->sum('prop_ecr') * 100,2);

		if ($this->batch_size && $this->plato_vol && $this->ecr && $this->efficiency)
		{
			$this->dt = round($this->batch_size * $this->plato_vol / (100 * $this->ecr_pct * $this->efficiency_pct),2);

			foreach ($this->fermentables as $grain)
			{
				$grain->amount = bcmul($grain->percent_pct ,$this->dt,2);
				if ($this->batch_size)
				{
					$grain->mcu = 4.24 * $grain->color * $grain->amount / $this->batch_size;
				}
				$total_grain += $grain->amount; 
				$grain->save();
			}

			//roundoff difference
			$diff = bcsub($this->dt, $total_grain, 2); 
			if ($diff)
			{
				$fermentable_model = BaseModel::create('recipe_fermentables');
				$fermentable = $fermentable_model->filter('recipe_id', $this->id)->first();
				$fermentable->amount = bcadd($fermentable->amount, $diff,2 );
				$fermentable->save();
			}
			$this->color = round(2.939634 * pow($this->fermentables->sum('mcu'), 0.685) );
		}
		else
		{
			$this->dt = null;
		}

		$this->save();
	}

	function calcIBU()
	{
		foreach ($this->hops as $hop)
		{	
			$hop->calcIBU();
			$hop->save();
		}
	}

	function updateData(Request $request)
	{
		parent::updateData($request);

//		$this->evap_rate = $this->evap_rate / 10000;

		if ($this->batch_size && $this->boil)
		{
			$this->post_boil_size = round(($this->batch_size  + $this->boil->loss) / 0.96, 2);
			$this->boil_size = round($this->post_boil_size * (1 + (($this->boil->loss_pct/100) * ($this->boil_time/60))), 2); 
		}
		else
		{
			$this->post_boil_size = null;
			$this->boil_size = null;
		}

		if ($this->plato)
		{
			$plato = BaseModel::create('extract_conv')::where('mass', $this->plato);
			$this->plato_vol = $plato->get()->first()->vol;
		}

		$this->calcGrain();

		$this->calcMashWater();

		$this->calcIBU();

		$this->save();
	}
}