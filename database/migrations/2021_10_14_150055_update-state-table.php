<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('states', function (Blueprint $table) {
            // $table->id();
          
            $table->integer('country_id')->after('name')->default(0);
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
        Schema::table('states', function (Blueprint $table) {
            // $table->id();
          
            $table->dropColumn('country_id');
        });
    }
}
