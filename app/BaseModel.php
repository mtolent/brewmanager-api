<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fermentable;
use App\Hop;
use App\Yeat;
use App\Recipe;
use App\RecipeFermentables;
use App\ExtractConv;
use Illuminate\Http\Request;

class BaseModel extends Model
{
    public static function create($name)
    {
    	$className = 'App\\' . studly_case(str_singular($name));

		if(class_exists($className)) {
		    $model = new $className;
		}
		else {
			return 'Class ' + $name +' not found.';
		}

		return $model;
    }

	function updateData(Request $request)
	{
		//some validation perhaps?
		$this->fill($request->all());
        $this->save();
	}

	function insertData(Request $request)
	{
		//some validation perhaps?
		$this->fill($request->all());
        $this->save();
	}

	function deleteRecord()
	{
		//some validation perhaps?
		$this->delete();
	}
}
