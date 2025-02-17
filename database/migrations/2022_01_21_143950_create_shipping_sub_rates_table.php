<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingSubRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_sub_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_rate_id');
            $table->double('from');
            $table->double('to')->nullable();
            $table->string('rate_type');
            $table->string('charge_type');
            $table->string('apply_type');
            $table->string('weight');
            $table->double('rate');
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('shipping_sub_rates');
    }
}
