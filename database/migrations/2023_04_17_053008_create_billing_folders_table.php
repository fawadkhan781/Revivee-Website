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
        Schema::create('billing_folders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('year',100);
            $table->string('month',100);
            $table->string('title',255)->unique();
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
        Schema::dropIfExists('billing_folders');
    }
};
