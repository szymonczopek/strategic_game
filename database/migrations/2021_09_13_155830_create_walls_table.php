<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level')->default(1);
            $table->integer('health')->default(100);
            $table->float('healthRatio')->default(1.5);
            $table->integer('buildTime')->default(3600);
            $table->float('buildTimeRatio')->default(1.2);
            $table->integer('buildEnd')->nullable();
            $table->integer('wood')->default(10000);
            $table->integer('stone')->default(10000);
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
        Schema::dropIfExists('walls');
    }
}
