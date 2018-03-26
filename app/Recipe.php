<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Recipe extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'recipes';

	protected $fillable = array('name','comments','batch_size','boil_size','boil_time','efficiency','ibu',
								'dt','brew_date', 'plato', 'evap_rate', 'post_boil_size', 'plato_vol',
								'evap_rate_pct', 'color');

 	public function fermentables()
    {
        return $this->hasMany('App\RecipeFermentable');
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
        $recipe = BaseModel::create('recipe_fermentables')::where('recipe_id', 1);
        return $recipe->get()->sum('percent');
	}

	public function calcGrain()
	{
        $this->ecr = round($this->fermentables->sum('prop_ecr') * 100,2);
        $this->color = round($this->fermentables->sum('prop_color') * ($this->plato/8.6));

		if ($this->batch_size && $this->plato_vol && $this->ecr && $this->efficiency)
		{
			$this->dt = $this->batch_size * $this->plato_vol / (100 * $this->ecr_pct * $this->efficiency_pct);

			foreach ($this->fermentables as $grain)
			{
				$grain->amount = $grain->percent_pct * $this->dt;
				$grain->save();
			}
		}
		else
		{
			$this->dt = null;
		}


		$this->save();
	}

	function updateData(Request $request)
	{
		parent::updateData($request);

//		$this->evap_rate = $this->evap_rate / 10000;

		if ($this->batch_size)
		{
			$this->post_boil_size = $this->batch_size / 0.96; 
			$this->boil_size = $this->post_boil_size * (1 + ($this->evap_rate_pct * ($this->boil_time/60))); 
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

		$this->save();
	}
}