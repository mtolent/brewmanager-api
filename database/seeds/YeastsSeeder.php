<?php

use Illuminate\Database\Seeder;

class YeastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('yeasts')->insert([
            'name' => 'US-05'
        ]);
    }
}
