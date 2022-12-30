<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillageForcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_forces', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('amount');

            $table->integer('idVillage')->unsigned();
            $table->integer('idSoldier')->unsigned();
            $table->foreign('idVillage')->references('id')->on('villages');
            $table->foreign('idSoldier')->references('id')->on('soldiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village_forces');
    }
}
