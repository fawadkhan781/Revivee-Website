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
        Schema::create('user_credential_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credential_id')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade");
            $table->integer('step_1')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade")->default(0);
            $table->integer('step_2')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade")->default(0);
            $table->integer('step_3')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade")->default(0);
            $table->integer('step_4')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade")->default(0);
            $table->integer('step_5')->unsigned()->index()->foreign()->references("credential_id")->on("credentials")->onDelete("cascade")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_credential_steps');
    }
};
