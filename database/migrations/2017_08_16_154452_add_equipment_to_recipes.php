<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEquipmentToRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->integer('mash_id')->unsigned()->nullable();
            $table->foreign('mash_id')->references('id')->on('equipments');
            $table->integer('boil_id')->unsigned()->nullable();
            $table->foreign('boil_id')->references('id')->on('equipments');
            $table->integer('ferm_id')->unsigned()->nullable();
            $table->foreign('ferm_id')->references('id')->on('equipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            //
        });
    }
}
