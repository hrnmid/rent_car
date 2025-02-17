<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTbl extends Migration
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
            $table->integer('type')->after('id');
            $table->string('name_prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country_code_phone');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->integer('country');
            $table->integer('state');
            $table->string('postal_code');
            $table->integer('branch_id');
            // $table->dropColumn('name');
            // $table->string('full_name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->string('phone');
            // $table->rememberToken();
            // $table->timestamps();
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
            $table->dropColumn('type');
            $table->dropColumn('name_prefix');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('country_code_phone');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('state');
            $table->dropColumn('postal_code');
            $table->dropColumn('branch_id');

        });
    }
}
