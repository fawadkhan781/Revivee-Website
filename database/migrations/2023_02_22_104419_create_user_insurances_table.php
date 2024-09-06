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
        Schema::create('user_insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id')->unsigned()->index()->foreign()->references("credential_id")->on("crendentials")->onDelete("cascade");
            $table->integer('insurance_id')->unsigned()->index()->foreign()->references("id")->on("insurances")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_insurances');
    }
};
