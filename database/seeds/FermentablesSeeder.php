<?php

use Illuminate\Database\Seeder;

class FermentablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fermentables')->insert([
            'name' => 'MALTE PALE ALE'
        ]);
        DB::table('fermentables')->insert([
            'name' => 'MALTE CARAMUNCH ® TIPO I'
        ]);
    }
}
