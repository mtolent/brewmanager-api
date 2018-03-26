<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BaseModel;
use Illuminate\Support\Facades\Input;

class DataController extends Controller
{
    public function show($t, $id)
    {
        $model = BaseModel::create($t)::find($id);
        return $model;
    }
    public function index($t, $d = null)
    {
        $model = BaseModel::create($t);
        return $model->all();
    }
    public function filter($t, $f, $d = null)
    {
        $model = BaseModel::create($t);
        return $model->where($f, $d)->get();
    }
    public function update($t, $id, Request $request) {
        $data = BaseModel::create($t)::find($id);
        $data->updateData($request);
        return $data;
    }
    public function store($t, Request $request) {
        $data = BaseModel::create($t);
        $data->insertData($request);
        return $data;
    }
    public function destroy($t, $id) {
        $data = BaseModel::create($t)::find($id);
        $data->deleteRecord();
        return $data;
    }
    public function move()
    {
        $file = \Input::file('photo'); // retorna o objeto em questão

        $content = File::get($file->getRealPath());
        $xml = simplexml_load_string($content);
        $json = json_encode($xml);
        $array = json_decode($json, true);

        $data = new Fermentable();
        $data->name = $array['FERMENTABLE']['NAME'];
        $data->save();

        return back()->withInput();
    }
    public function teste()
    {
        $recipe = BaseModel::create('recipe')::find(1);

//        $recipe_fermentable = $recipe->fermentables;
        //return $recipe_fermentable;
//       $recipe->name = 'DOUBLE IPA';
//        $recipe->save();

        return $recipe->fermentables->sum('prop_ecr');
    }
}
