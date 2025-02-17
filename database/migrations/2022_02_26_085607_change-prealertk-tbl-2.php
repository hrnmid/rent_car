<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePrealertkTbl2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_alerts', function (Blueprint $table) {
            $table->integer('admin_staff_id')->default(0)->nullable();
            $table->dateTime('booking_date')->nullable();
            $table->integer('no_of_pieces')->nullable();
            $table->string('payment_mode')->nullable();
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
