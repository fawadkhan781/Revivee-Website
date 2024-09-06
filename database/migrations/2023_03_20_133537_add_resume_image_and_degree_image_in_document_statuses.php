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
        Schema::table('document_statuses', function (Blueprint $table) {
            $table->tinyInteger('resume_image')->default(2);
            $table->string('resume_image_message',255)->nullable();
            $table->tinyInteger('degree_image')->default(2);
            $table->string('degree_image_message',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_statuses', function (Blueprint $table) {
            $table->dropColumn('resume_image');
            $table->dropColumn('resume_image_message');
            $table->dropColumn('degree_image');
            $table->dropColumn('degree_image_message');
        });
    }
};
