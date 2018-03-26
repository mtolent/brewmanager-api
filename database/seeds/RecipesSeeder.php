<?php

use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            'name' => 'Porter ICB',
            'plato' => 14,
            'ibu' => 30,
            'efficiency' => 82,
            'boil_time' => 70,
            'evap_rate' =>4
        ]);
        DB::table('recipes')->insert([
            'name' => 'IPA'
        ]);
    }
}
