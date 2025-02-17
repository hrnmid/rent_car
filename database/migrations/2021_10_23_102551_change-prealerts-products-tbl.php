<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePrealertsProductsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pre_alerts_products', function (Blueprint $table) {
            // $table->id();
          
            $table->string('decription')->default("")->nullable()->change();
            $table->string('weight_scale')->default("")->nullable()->change();
            $table->string('size_scale')->default("")->nullable()->change();
            $table->decimal('length',11,2)->nullable()->change();
            $table->decimal('width',11,2)->nullable()->change();
            $table->decimal('height',11,2)->nullable()->change();
            $table->decimal('dimensional_weight',11,2)->nullable()->change();
            $table->decimal('actual_weight',11,2)->nullable()->change();
            $table->decimal('final_weight',11,2)->nullable()->change();
            $table->integer('qty')->nullable()->change();
            $table->string('currency')->default("")->nullable()->change();
            $table->decimal('value',11,2)->nullable()->change();
            $table->decimal('total',11,2)->nullable()->change();
            $table->renameColumn('decription','description');

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
        Schema::table('pre_alerts_products', function (Blueprint $table) {
            // $table->id();
          
            $table->renameColumn('description','decription');
        });
    }
}
