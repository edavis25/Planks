<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_images', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('imageable');
            $table->string('filename');
            $table->string('filepath');
            $table->string('filetype');
            $table->string('size');
            $table->string('disk');
            $table->string('uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_images');
    }
}
