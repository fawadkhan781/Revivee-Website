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
        Schema::table('user_credential_steps', function (Blueprint $table) {
            $table->dropColumn(['step_1', 'step_2','step_3', 'step_4','step_5']);
            $table->integer('step');
            $table->integer('is_approved')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_credential_steps', function (Blueprint $table) {
            $table->dropColumn('step');
            $table->dropColumn('is_approved');
        });
    }
};
