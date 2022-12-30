<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level')->default(1);
            $table->integer('bonus')->default(5);
            $table->integer('bonusUpgrade')->default(5);
            $table->integer('buildTime')->default(3600);
            $table->integer('buildEnd')->nullable();
            $table->float('buildTimeRatio')->default(1.2);
            $table->integer('wood')->default(10000);
            $table->integer('stone')->default(10000);
            $table->float('buildRatio')->default(1.6);

            $table->integer('idBonusBuildingName')->unsigned();
            $table->foreign('idBonusBuildingName')->references('id')->on('bonus_building_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_buildings');
    }
}
