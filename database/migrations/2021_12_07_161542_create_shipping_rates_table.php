<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id")->nullable();
            $table->integer("origin");
            $table->integer("destination");
            $table->string("shipment_type")->nullable();
            $table->string("shipping_mode")->nullable();
            $table->string("shipping_charge")->nullable();
            $table->string("weight_scale")->nullable();
            $table->double("from")->nullable();
            $table->double("to")->nullable();
            $table->string("rate_currency");
            $table->string("rate_name");
            $table->double("rate");
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
        Schema::dropIfExists('shipping_rates');
    }
}
