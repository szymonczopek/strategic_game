<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArmyBattleForcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('army_battle_forces', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('amount');

            $table->integer('idArmy')->unsigned();
            $table->integer('idBattle')->unsigned();
            $table->foreign('idArmy')->references('id')->on('armies')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('army_battle_forces');
    }
}
