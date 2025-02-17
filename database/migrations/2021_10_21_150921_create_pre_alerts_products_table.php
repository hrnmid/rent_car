<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreAlertsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_alerts_products', function (Blueprint $table) {
            $table->id();
            $table->integer('pre_alert_id');
            $table->string('decription');
            $table->integer('weight_scale');
            $table->integer('size_scale');
            $table->decimal('length',11,2);
            $table->decimal('width',11,2);
            $table->decimal('height',11,2);
            $table->decimal('dimensional_weight',11,2);
            $table->decimal('actual_weight',11,2);
            $table->decimal('final_weight',11,2);
            $table->integer('qty');
            $table->integer('currency');
            $table->decimal('value',11,2);
            $table->decimal('total',11,2);
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
        Schema::dropIfExists('pre_alerts_products');
    }
}
