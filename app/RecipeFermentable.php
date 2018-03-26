<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecipeFermentable extends BaseModel
{
	protected $primaryKey = 'id';
	protected $table = 'recipe_fermentables';

	protected $fillable = array('name', 'recipe_id', 'fermentable_id', 'amount', 'yield', 'color', 'percent');

	public function Recipe()
    {
        return $this->belongsTo('App\Recipe');
    }

	public function Fermentable()
    {
        return $this->belongsTo('App\Fermentable');
    }

	function getPropEcrAttribute()
	{
		if ($this->percent && $this->yield)
		{
			return $this->percent_pct * $this->yield_pct;
		}

		return 0;
	}

	function getPropColorAttribute()
	{
		if ($this->percent && $this->color)
		{
			return $this->percent_pct * $this->color;
		}

		return 0;
	}

	function getPercentPctAttribute()
	{
		return $this->percent / 100;
	}

	function getYieldPctAttribute()
	{
		return $this->yield / 100;
	}

	function updateData(Request $request)
	{
		parent::updateData($request);

		$this->recipe->calcGrain();

		$this->save();
	}

	function insertData(Request $request)
	{
		parent::insertData($request);

		$this->initFromFermentable();
		$this->save();
	}

	function initFromFermentable()
	{
		$fermentable = $this->fermentable;

		$this->name = $fermentable->name;
		$this->color = $fermentable->color;
		$this->yield = $fermentable->yield;
	}

	function deleteRecord()
	{
		//some validation perhaps?
		$recipe = $this->recipe;
		$this->delete();
		$recipe->calcGrain();
	}
}
