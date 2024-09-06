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
        Schema::create('credentialing_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id');
            $table->integer('user_id');
            $table->string('state_license_image')->nullable();
            $table->string('accreditation_image')->nullable();
            $table->string('irs_letter_image')->nullable();
            $table->string('bank_letter_image')->nullable();
            $table->string('professional_liability_insurance_image')->nullable();
            $table->string('driver_license_image')->nullable();
            $table->string('w9_form_image')->nullable();
            $table->string('additional_document_image')->nullable();
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
        Schema::dropIfExists('credentialing_documents');
    }
};
