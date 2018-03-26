<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',75)->unique();
            $table->text('comments')->nullable();
            $table->double('plato')->nullable();
            $table->double('plato_vol')->nullable();
            $table->double('evap_rate')->nullable();
            $table->double('batch_size')->nullable();
            $table->double('post_boil_size')->nullable(); //apronte
            $table->double('boil_size')->nullable();
            $table->double('boil_time')->nullable();
            $table->double('mash_size')->nullable();
            $table->double('mash_loss')->nullable();
            $table->double('mash_water_rate')->nullable();
            $table->double('efficiency')->nullable();
            $table->double('ibu')->nullable();
            $table->double('dt')->nullable();
            $table->double('ecr')->nullable();
            $table->double('color')->nullable();
            $table->double('fermentables_pct')->nullable();
            $table->date('brew_date')->nullable();
            $table->timestamps();
        });
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipes');
    }
}
