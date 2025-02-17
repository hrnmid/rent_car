<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePrealertTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pre_alerts', function (Blueprint $table) {
            // $table->id();
          
            $table->renameColumn('courier_id','courier');
            $table->string("shipping_mode")->default(0)->nullable()->change();
            $table->string("shipment_type")->default(0)->nullable()->change();
            $table->string("consolidation_required")->default(0)->nullable()->change();
            $table->string("receiver_country")->default(0)->nullable()->change();
            $table->string("receiver_state")->default(0)->nullable()->change();
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
        Schema::table('pre_alerts', function (Blueprint $table) {
            // $table->id();
          
            $table->renameColumn('courier','courier_id');
        });
    }
}
