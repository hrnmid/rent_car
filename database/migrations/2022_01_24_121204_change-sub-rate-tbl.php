<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSubRateTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_sub_rates', function (Blueprint $table) {
            $table->string('weight')->change();
            $table->dropColumn('to');
            $table->dropColumn('apply_type');
            $table->dropColumn('charge_type');
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
