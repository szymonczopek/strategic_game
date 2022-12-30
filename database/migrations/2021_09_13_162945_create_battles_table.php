<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('startingBattle');
            $table->string('wonBattle');
            $table->integer('time');
            $table->integer('rewardWood');
            $table->integer('rewardStone');
            $table->integer('rewardFood');
            $table->integer('rewardGold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battles');
    }
}
