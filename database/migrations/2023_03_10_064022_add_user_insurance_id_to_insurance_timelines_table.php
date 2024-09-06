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
        Schema::table('insurance_timelines', function (Blueprint $table) {
            $table->dropColumn(['insurance_id', 'credential_id']);
            $table->integer('user_insurance_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_timelines', function (Blueprint $table) {
            $table->dropColumn('user_insurance_id');
        });
    }
};
