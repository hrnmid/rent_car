<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_alerts', function (Blueprint $table) {
            $table->id();
            $table->string("vendor_name")->default("")->nullable();
            $table->string("courier_id")->default("")->nullable();
            $table->string("courier_tracking_no")->default("")->nullable();
            $table->date("purchase_date")->nullable();
            $table->string("purchase_invoice_url")->default("")->nullable();
            $table->integer("shipping_address")->default(0)->nullable();
            $table->integer("shipping_mode")->default(0)->nullable();
            $table->integer("shipment_type")->default(0)->nullable();
            $table->integer("consolidation_required")->default(0)->nullable();
            $table->integer("total_orders")->default(0)->nullable();
            $table->string("receiver_name")->default("")->nullable();
            $table->string("receiver_phone")->default("")->nullable();
            $table->string("receiver_street_address")->default("")->nullable();
            $table->string("receiver_city")->default("")->nullable();
            $table->integer("receiver_country")->default(0)->nullable();
            $table->integer("receiver_state")->default(0)->nullable();
            $table->string("receiver_zipcode")->default("")->nullable();
            $table->integer("created_by");
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
        Schema::dropIfExists('pre_alerts');
    }
}
