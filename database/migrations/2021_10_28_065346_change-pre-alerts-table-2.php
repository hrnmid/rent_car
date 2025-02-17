<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePreAlertsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_alerts', function (Blueprint $table) {
            // $table->id();
          
            $table->string("sender_name")->default("")->nullable();
            $table->string("sender_phone")->default("")->nullable();
            $table->string("sender_street_address")->default("")->nullable();
            $table->string("sender_city")->default("")->nullable();
            $table->string("sender_country")->default("")->nullable();
            $table->string("sender_state")->default("")->nullable();
            $table->string("sender_zipcode")->default("")->nullable();
            $table->string("total_weight")->default("")->nullable()->after('shipping_mode');
            $table->string("shipment_payer")->default("")->nullable()->after('total_weight');
            $table->string("instructions")->default("")->nullable()->after('shipment_payer');


            $table->string("shipping_mode")->default("")->nullable()->change();
            $table->string("shipment_type")->default("")->nullable()->change();
            $table->string("consolidation_required")->default("")->nullable()->change();
            $table->string("receiver_country")->default("")->nullable()->change();
            $table->string("receiver_state")->default("")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
