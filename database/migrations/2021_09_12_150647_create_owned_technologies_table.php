<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnedTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owned_technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('idCity')->unsigned();
            $table->integer('idTechnology')->unsigned();
            $table->foreign('idCity')->references('id')->on('cities')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->foreign('idTechnology')->references('id')->on('technologies')->cascadeOnUpdate()->cascadeOnDelete();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owned_technologies');
    }
}
