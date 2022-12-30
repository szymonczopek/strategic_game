<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('level')->default(1);
            $table->integer('protectedStock')->default(5000);
            $table->float('protectedStockRatio')->default(1.5);
            $table->integer('buildTime')->default(3600);
            $table->float('buildTimeRatio')->default(1.2);
            $table->integer('buildEnd')->nullable();
            $table->integer('wood')->default(2000);
            $table->integer('stone')->default(2000);
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
        Schema::dropIfExists('stores');
    }
}
