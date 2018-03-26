<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeFermentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_fermentables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fermentable_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->text('name');
            $table->text('origin')->nullable();
            $table->text('type')->nullable();
            $table->double('amount')->nullable();
            $table->double('percent')->nullable();
            $table->double('yield')->nullable();
            $table->double('color')->nullable();
            $table->boolean('add_after_boil')->nullable();
            $table->text('supplier')->nullable();
            $table->double('coarse_fine_diff')->nullable();
            $table->double('moisture')->nullable();
            $table->double('diastatic_power')->nullable();
            $table->double('protein')->nullable();
            $table->double('max_in_batch')->nullable();
            $table->boolean('recommend_mash')->nullable();
            $table->double('ibu_gal_per_lb')->nullable();
            $table->double('potential')->nullable();
            $table->timestamps();        

            $table->foreign('fermentable_id')->references('id')->on('fermentables');
            $table->foreign('recipe_id')->references('id')->on('recipes');
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipe_fermentables');
    }
}
