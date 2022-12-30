<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stables', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level')->default(1);
            $table->integer('horseAmount')->default(1);
            $table->float('horseRatio')->default(0);
            $table->integer('horseMax')->default(10);
            $table->float('horseMaxRatio')->default(1.4);
            $table->integer('buildTime')->default(3600);
            $table->float('buildTimeRatio')->default(1.2);
            $table->integer('stableWorkTime')->nullable();
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
        Schema::dropIfExists('stables');
    }
}
