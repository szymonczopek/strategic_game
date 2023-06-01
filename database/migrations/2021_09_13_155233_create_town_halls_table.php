<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('town_halls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level');
            $table->integer('population');
            $table->float('populationRatio');
            $table->integer('populationMax');
            $table->integer('populationTime');
            $table->integer('freeWorkTime');
            $table->integer('woodWorkTime');
            $table->integer('stoneWorkTime');
            $table->integer('agroWorkTime');
            $table->integer('populationForest');
            $table->integer('populationStonepit');
            $table->integer('populationAgro');
            $table->integer('populationFree');
            $table->integer('forestRatio');
            $table->integer('stonepitRatio');
            $table->integer('agroRatio');
            $table->integer('buildTime');
            $table->integer('buildEnd')->nullable();
            $table->integer('wood');
            $table->integer('stone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('town_halls');
    }
}
