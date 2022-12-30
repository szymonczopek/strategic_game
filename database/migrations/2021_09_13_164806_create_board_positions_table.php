<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_positions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('position');

            $table->integer('idCity')->unsigned();
            $table->integer('idStore')->unsigned()->nullable();
            $table->integer('idWall')->unsigned()->nullable();
            $table->integer('idStable')->unsigned()->nullable();
            $table->integer('idTownHall')->unsigned()->nullable();
            $table->integer('idArmy')->unsigned()->nullable();
            $table->integer('idUniversity')->unsigned()->nullable();
            $table->integer('idBonusBuilding')->unsigned()->nullable();
            $table->foreign('idCity')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idStore')->references('id')->on('stores')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idWall')->references('id')->on('walls')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idStable')->references('id')->on('stables')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idTownHall')->references('id')->on('town_halls')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idArmy')->references('id')->on('armies')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idUniversity')->references('id')->on('universities')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('idBonusBuilding')->references('id')->on('bonus_buildings')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('board_positions');
    }
}
