<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVaTbl1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('virtual_addresses', function (Blueprint $table) {
            // $table->id();
          
            $table->string('zip')->default("")->nullable()->after('country_zip');
            $table->renameColumn('country_zip','country');
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
