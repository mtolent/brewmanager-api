<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipeHops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_hops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hop_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->text('name');
            $table->text('comments')->nullable();
            $table->text('origin')->nullable();
            $table->double('alpha')->nullable();
            $table->double('amount')->nullable();
            $table->text('use')->nullable();
            $table->double('time')->nullable();
            $table->text('notes')->nullable();
            $table->text('type')->nullable();
            $table->text('form')->nullable();
            $table->double('beta')->nullable();
            $table->double('hsi')->nullable();
            $table->timestamps();

            $table->foreign('hop_id')->references('id')->on('hops');
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
        Schema::dropIfExists('recipe_hops');
    }
}
