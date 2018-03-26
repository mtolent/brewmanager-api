<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecipeHop extends BaseModel
{
	protected $primaryKey = 'id';
	// protected $table = 'recipe_hopsx';

	protected $appends = ['bigness_factor', 'boil_time_factor'];

	protected $hidden = ['recipe'];

	protected $fillable = array('name', 'recipe_id', 'hop_id', 'amount', 'alpha', 'time', 'ibu', 'percent');

	public function Recipe()
	{
			return $this->belongsTo('App\Recipe');
	}

	public function Hop()
	{
			return $this->belongsTo('App\Hop');
	}

	function calcIBU()
	{
		$recipe = $this->recipe;
		$this->ibu = $recipe->ibu * $this->percent / 100;
		if (($recipe->batch_size * $this->ibu) > 0)
		{
			//$this->ibu = round((10 * $this->bigness_factor * $this->boil_time_factor * $this->alpha * $this->amount) / $this->recipe->batch_size,0);
			//$this->amount = round((10 * $this->bigness_factor * $this->boil_time_factor * $this->alpha) / ($recipe->batch_size * $this->ibu),0);
			$this->amount = round(($recipe->batch_size * $this->ibu) /  ($this->bigness_factor * $this->boil_time_factor * $this->alpha * 10),0);
			//$this->amount =  $recipe->batch_size * $this->ibu;
		}
	}
	function updateData(Request $request)
	{
		parent::updateData($request);

		$this->calcIBU();

		$this->save();
	}

	function insertData(Request $request)
	{
		parent::insertData($request);

		$this->initFromHop();
		$this->save();
	}

	function getBignessFactorAttribute()
	{
		return 1.65 * pow(0.000125,$this->recipe->og - 1);
	}

	function getBoilTimeFactorAttribute()
	{
		//1 - e^(-0.04 * time in mins)
		//----------------------------
		//             4.15
		return (1 - exp(-0.04 * $this->time)) / 4.15;
	}

	function initFromHop()
	{
		$hop = $this->hop;

		$this->name = $hop->name;
	}

	function deleteRecord()
	{
		//some validation perhaps?
		$recipe = $this->recipe;
		$this->delete();
		//$recipe->calcGrain();
	}

	function filter($f, $d)
	{
		//return $this->where($f, $d)->orderBy('percent','DESC')->get();
		return $this->where($f, $d)->orderBy('time','DESC')->get();
	}
}
