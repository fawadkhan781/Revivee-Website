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
        Schema::table('credentialing_documents', function (Blueprint $table) {
            $table->string('resume_image',255)->nullable();
            $table->string('degree_image',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('credentialing_documents', function (Blueprint $table) {
            $table->dropColumn('resume_image');
            $table->dropColumn('degree_image');
        });
    }
};
