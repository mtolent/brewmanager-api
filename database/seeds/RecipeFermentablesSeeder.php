<?php

use Illuminate\Database\Seeder;

class RecipeFermentablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_fermentables')->insert([
            'recipe_id' => 1,
            'fermentable_id' => 2,
            'name' => 'MALTE PALE ALE',
            'percent' => 72
        ]);

        DB::table('recipe_fermentables')->insert([
            'recipe_id' => 1,
            'fermentable_id' => 2,
            'name' => 'MALTE CARAMUNCH ® TIPO I',
            'percent' => 10
        ]);
        
        DB::table('recipe_fermentables')->insert([
            'recipe_id' => 2,
            'fermentable_id' => 1,
            'name' => 'Pale Ale'
        ]);
    }
}
