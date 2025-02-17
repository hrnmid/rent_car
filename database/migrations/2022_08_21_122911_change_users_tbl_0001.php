<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersTbl0001 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable()->after('email');
            $table->string('alt_phone')->nullable()->after('phone');
            $table->string('identity_type')->nullable()->after('alt_phone');
            $table->string('identity_number')->nullable()->after('identity_type');
            $table->tinyInteger('is_active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('alt_phone');
            $table->dropColumn('identity_type');
            $table->dropColumn('identity_number');
            $table->dropColumn('is_active');
        });
    }
}
