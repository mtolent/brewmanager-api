<?php

use Illuminate\Database\Seeder;

class HopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hops')->insert([
            'name' => 'Citra',
            'origin' => 'US',
            'alpha' => 11
        ]);
    }
}
