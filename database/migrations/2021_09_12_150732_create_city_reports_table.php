<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date');
            $table->string('content');

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
        Schema::dropIfExists('city_reports');
    }
}
