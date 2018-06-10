<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->boolean('used');
            $table->unsignedInteger('created_by_user_id');
            $table->unsignedInteger('code_used_by_user_id')->nullable();
            $table->timestamps();
        });

        // Add in foreign key constraints
        Schema::table('registration_codes', function (Blueprint $table) {
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('code_used_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registration_codes', function(Blueprint $table) {
            $table->dropForeign(['created_by_user_id']);
            $table->dropForeign(['code_used_by_user_id']);
        });
        Schema::dropIfExists('registration_codes');
    }
}
