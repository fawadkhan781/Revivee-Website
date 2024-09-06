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
        Schema::create('credential_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade");
            $table->tinyInteger('group_name')->default(2);
            $table->string('group_name_message',255)->nullable();
            $table->tinyInteger('group_npi')->default(2);
            $table->string('group_npi_message',255)->nullable();
            $table->tinyInteger('legal_name')->default(2);
            $table->string('legal_name_message',255)->nullable();
            $table->tinyInteger('ein_tin')->default(2);
            $table->string('ein_tin_message',255)->nullable();
            $table->tinyInteger('owner_dob')->default(2);
            $table->string('owner_dob_message',255)->nullable();
            $table->tinyInteger('provider_name')->default(2);
            $table->string('provider_name_message',255)->nullable();
            $table->tinyInteger('provider_npi')->default(2);
            $table->string('provider_npi_message',255)->nullable();
            $table->tinyInteger('ssn_number')->default(2);
            $table->string('ssn_number_message',255)->nullable();
            $table->tinyInteger('service_address')->default(2);
            $table->string('service_address_message',255)->nullable();
            $table->tinyInteger('billing_mailing_address')->default(2);
            $table->string('billing_mailing_address_message',255)->nullable();
            $table->tinyInteger('medicare_id')->default(2);
            $table->string('medicare_id_message',255)->nullable();
            $table->tinyInteger('start_date')->default(2);
            $table->string('start_date_message',255)->nullable();
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
        Schema::dropIfExists('credential_statuses');
    }
};
