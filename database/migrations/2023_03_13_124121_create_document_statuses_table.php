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
        Schema::create('document_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade");
            $table->tinyInteger('state_license_image')->default(2);
            $table->string('state_license_image_message',255)->nullable();
            $table->tinyInteger('accreditation_image')->default(2);
            $table->string('accreditation_image_message',255)->nullable();
            $table->tinyInteger('irs_letter_image')->default(2);
            $table->string('irs_letter_image_message',255)->nullable();
            $table->tinyInteger('bank_letter_image')->default(2);
            $table->string('bank_letter_image_message',255)->nullable();
            $table->tinyInteger('professional_liability_insurance_image')->default(2);
            $table->string('professional_liability_insurance_image_message',255)->nullable();
            $table->tinyInteger('driver_license_image')->default(2);
            $table->string('driver_license_image_message',255)->nullable();
            $table->tinyInteger('w9_form_image')->default(2);
            $table->string('w9_form_image_message',255)->nullable();
            $table->tinyInteger('additional_document_image')->default(2);
            $table->string('additional_document_image_message',255)->nullable();
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
        Schema::dropIfExists('document_statuses');
    }
};
