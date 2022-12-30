<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('cityName');
            $table->integer('gold')->default(50);
            $table->integer('wood')->default(50);
            $table->integer('stone')->default(50);
            $table->integer('food')->default(50);
            $table->integer('technologyPoints')->default(0);

            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
