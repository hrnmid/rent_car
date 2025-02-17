<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePreAlertTable00001 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pre_alerts', function (Blueprint $table) {
            $table->string('sender_email')->nullable()->after('sender_phone');
            $table->string('receiver_email')->nullable()->after('receiver_phone');
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
