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
        Schema::create('billing_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('billing_folder_id');
            $table->string('documents',256);
            $table->tinyInteger('status')->default(1);
            $table->timestamp('added_on')->nullable();
            $table->timestamp('modified_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_documents');
    }
};