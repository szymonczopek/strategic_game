<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level')->default(1);
            $table->integer('waitingTime')->default(3600);
            $table->float('waitingTimeRatio')->default(1.2);
            $table->integer('revenge')->default(5);
            $table->integer('revengeShift')->default(5);
            $table->integer('wallHealth')->default(500);
            $table->float('wallHealthRatio')->default(1.5);
            $table->integer('rewardWood')->default(1000);
            $table->integer('rewardStone')->default(1000);
            $table->integer('rewardGold')->default(1000);
            $table->integer('rewardFood')->default(1000);
            $table->float('rewardRatio')->default(1.4);

            $table->integer('idCity')->unsigned();
            $table->foreign('idCity')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villages');
    }
}
