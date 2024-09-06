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
        Schema::create('login_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade");
            $table->tinyInteger('nppes_username')->default(2);
            $table->string('nppes_username_message',255)->nullable();
            $table->tinyInteger('nppes_password')->default(2);
            $table->string('nppes_password_message',255)->nullable();
            $table->tinyInteger('caqh_username')->default(2);
            $table->string('caqh_username_message',255)->nullable();
            $table->tinyInteger('caqh_password')->default(2);
            $table->string('caqh_password_message',255)->nullable();
            $table->tinyInteger('provider_source_username')->default(2);
            $table->string('provider_source_username_message',255)->nullable();
            $table->tinyInteger('provider_source_password')->default(2);
            $table->string('provider_source_password_message',255)->nullable();
            $table->tinyInteger('availity_state')->default(2);
            $table->string('availity_state_message',255)->nullable();
            $table->tinyInteger('availity_username')->default(2);
            $table->string('availity_username_message',255)->nullable();
            $table->tinyInteger('availity_password')->default(2);
            $table->string('availity_password_message',255)->nullable();
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
        Schema::dropIfExists('login_statuses');
    }
};
