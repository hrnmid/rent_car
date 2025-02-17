<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_shipments', function (Blueprint $table) {
            $table->id();
            $table->integer('container_id');
            $table->integer('shipment_id');
            $table->integer('driver_id');
            $table->string('service_type');
            $table->date('assigning_date');
            $table->integer('status')->default(0);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('driver_shipments');
    }
}
