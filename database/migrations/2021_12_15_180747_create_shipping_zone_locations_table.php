<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingZoneLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_zone_locations', function (Blueprint $table) {
            $table->id();
            $table->integer("shipping_zone_id");
            $table->string("country")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->string("code")->nullable();
            $table->boolean('is_active');
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
        Schema::dropIfExists('shipping_zone_locations');
    }
}
