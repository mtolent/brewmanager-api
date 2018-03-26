<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYeastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeasts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('type')->nullable(); // Ale, Lager
            $table->double('form')->nullable(); // Dry, Liquid
            $table->double('laboratory')->nullable();
            $table->double('min_temp')->nullable();
            $table->double('max_temp')->nullable();
            $table->text('floculation')->nullable(); //Medium, High, Low
            $table->double('attenuation')->nullable();
            $table->text('notes')->nullable();
            $table->integer('max_reuse')->nullable();
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
        Schema::dropIfExists('yeasts');
    }
}
