<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessNameUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            // $table->id();
          
            $table->string('business_name')->default("");
            $table->string('first_name')->default("")->nullable()->change();
            $table->string('last_name')->default("")->nullable()->change();
            $table->string('name_prefix')->default("")->nullable()->change();
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
        Schema::table('users', function (Blueprint $table) {
            // $table->id();
          
            $table->dropColumn('business_name');
        });
    }
}
