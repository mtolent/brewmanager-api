<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hops', function (Blueprint $table) {
            $table->increments('id');
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hops');
    }
}
