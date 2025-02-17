<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_addresses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address_line_1")->default("")->nullable();
            $table->string("address_line_2")->default("")->nullable();
            $table->string("city_state")->default("")->nullable();
            $table->string("country_zip")->default("")->nullable();
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
        Schema::dropIfExists('virtual_addresses');
    }
}
