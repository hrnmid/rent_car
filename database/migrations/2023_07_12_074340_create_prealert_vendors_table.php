<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrealertVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prealert_vendors', function (Blueprint $table) {
            $table->id();
            $table->string("vendor_name")->default("")->nullable();
            $table->string("courier")->default("")->nullable();
            $table->string("courier_tracking_no")->default("")->nullable();
            $table->date("purchase_date")->nullable();
            $table->string("purchase_invoice_url")->default("")->nullable();
            $table->integer("pre_alert_id");
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
        Schema::dropIfExists('prealert_vendors');
    }
}
