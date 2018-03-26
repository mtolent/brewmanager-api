<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(HopsSeeder::class);
        $this->call(FermentablesSeeder::class);
        $this->call(YeastsSeeder::class);
        $this->call(RecipesSeeder::class);
        $this->call(RecipeFermentablesSeeder::class);
        $this->call(ExtractConvSeeder::class);
    }
}
