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
            $table->integer('level')->default(1);
            $table->integer('population')->default(10);
            $table->float('populationRatio')->default(0);
            $table->integer('populationMax')->default(1000);
            $table->float('populationMaxRatio')->default(1.4);
            $table->integer('populationTime')->nullable();
            $table->integer('freeWorkTime')->nullable();
            $table->integer('woodWorkTime')->nullable();
            $table->integer('stoneWorkTime')->nullable();
            $table->integer('agroWorkTime')->nullable();
            $table->integer('populationForest')->default(0);
            $table->integer('populationStonepit')->default(0);
            $table->integer('populationAgro')->default(0);
            $table->integer('populationFree')->default(10);
            $table->integer('forestRatio')->default(10);
            $table->integer('stonepitRatio')->default(10);
            $table->integer('agroRatio')->default(10);
            $table->integer('buildTime')->default(3600);
            $table->float('buildTimeRatio')->default(1.2);
            $table->integer('buildEnd')->nullable();
            $table->integer('wood')->default(5000);
            $table->integer('stone')->default(5000);
            $table->float('buildRatio')->default(1.6);
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
