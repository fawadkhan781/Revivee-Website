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
        Schema::create('logins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id');
            $table->integer('user_id');
            $table->string('nppes_username')->nullable();
            $table->string('nppes_password')->nullable();
            $table->string('caqh_username')->nullable();
            $table->string('caqh_password')->nullable();
            $table->string('provider_source_username')->nullable();
            $table->string('provider_source_password')->nullable();
            $table->string('availity_state')->nullable();
            $table->string('availity_username')->nullable();
            $table->string('availity_password')->nullable();
            $table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('logins');
    }
};
