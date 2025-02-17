<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("airwaybill");
            $table->string("origin");
            $table->string("destination");
            $table->dateTime('departuredate', 0)->nullable();
            $table->dateTime('arrivaldate', 0)->nullable();
            $table->string("authorizedname")->nullable();
            $table->string("flightno")->nullable();
            $table->text("additionalinformation")->nullable();
            $table->integer("typeid");
            $table->boolean("is_active");
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
        Schema::dropIfExists('containers');
    }
}
