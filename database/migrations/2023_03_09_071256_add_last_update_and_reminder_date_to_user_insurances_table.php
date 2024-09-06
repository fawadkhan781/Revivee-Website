<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_insurances', function (Blueprint $table) {
            $table->dateTime('last_update_date')->nullable();
            $table->dateTime('up_coming_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_insurances', function (Blueprint $table) {
            $table->dropColumn('last_update_date');
            $table->dropColumn('up_coming_date');
        });
    }
};
