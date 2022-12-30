<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillageBattleForcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village_battle_forces', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('amount');

            $table->integer('idVillage')->unsigned();
            $table->integer('idBattle')->unsigned();
            $table->foreign('idVillage')->references('id')->on('villages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idBattle')->references('id')->on('battles')->cascadeOnUpdate()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village_battle_forces');
    }
}
