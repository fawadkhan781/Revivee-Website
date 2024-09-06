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
        Schema::create('billings', function (Blueprint $table) {
            $table->integer('billing_id')->primary();
            $table->integer('user_id')->nullable();
            $table->string('group_name',255);
            $table->integer('group_npi')->nullable();
            $table->string('legal_name',255)->nullable();
            $table->string('ein_tin',255)->nullable();
            $table->date('owner_dob');
            $table->string('provider_name',255)->nullable();
            $table->integer('provider_npi')->nullable();
            $table->integer('ssn')->nullable();
            $table->text('service_address')->nullable();
            $table->text('billing_mailing_address')->nullable();
            $table->integer('medicare_group_ptan')->nullable();
            $table->integer('medicare_individual_ptan')->nullable();
            $table->integer('medicare_id')->nullable();
            $table->date('start_date')->nullable();
            $table->string('sftlg_username',255)->nullable();
            $table->string('sftlg_password',255)->nullable();
            $table->string('wbplg_username',255)->nullable();
            $table->string('wbplg_password',255)->nullable();
            $table->string('billing_type',255)->nullable();
            $table->text('additional_note')->nullable();
            $table->text('insurance_network_list');
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
        Schema::dropIfExists('billings');
    }
};
